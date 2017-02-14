<?php

class ArticleController extends Controller
{

	public function actionIndex(){
		$this->layout='//layouts/article';
        $cats = Category::model()->findAll();
        $criteria=new CDbCriteria();
         if ($_GET['cat']) {
            $cat = Category::model()->findByPk($_GET['cat']);
            $art_cat = ArticleCategory::model()->findAllByAttributes(array('category_id' => $_GET['cat'] ));
            $rel_article_ids = array();
            foreach ($art_cat as $value) {
            	$rel_article_ids[] = $value->article_id;
            }
            $criteria->addInCondition('id', $rel_article_ids);
        }
        if ($_GET['search']) {
	        $criteria->addSearchCondition('title', '%'.$_GET['search'].'%' , false,'OR');
	        $criteria->addSearchCondition('content', '%'.$_GET['search'].'%' , false,'OR');
    	}
        $criteria->order = 'date DESC';
    	$criteria->compare('publish', 1);
        $count=Article::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $articles=Article::model()->findAll($criteria);
        $this->render('index', array(
            'articles' => $articles,
            'pages' => $pages,
            'cats' => $cats,
            'current_cat' => $cat,
        ));
	}


	public function actionView($id){
		$all_articles_params = array(
	        'condition'=>'publish=1 AND id<>'.$id,
	        'order'=>'date DESC',
	        'limit' => 5,
			);
		$all_articles = Article::model()->findAll($all_articles_params);
        $item = Article::model()->findByPk($id);
		if ($item->publish == 0 && (Yii::app()->user->name != 'admin' && Yii::app()->user->name != 'superadmin')){
			throw new CHttpException(404, 'Статья снята с публикации');
		}
		$this->layout='//layouts/article';
        $cats = $item->articleCategory;
        $arr = array();
        foreach ($cats as $cat) {
        	foreach ($cat->categoryArticle as $art) {
        		if ($art->publish) {
        			$arr[$art->id] = $art->title;
        		}
        	}
        }
        unset($arr[$item->id]);
        asort($arr);
        $arr = array_slice($arr, 0, 5, true);
        $last_cat = end($cats);

		$files = glob('images/product/'.$item->id.'-*');
		$images = array();
		if ($files) {
			foreach ($files as $filename) {
			    $images[] = $filename;
			}
		}

        $this->render('view', array(
            'item' => $item,
            'last_cat' => $last_cat,
            'related_articles' => $arr,
            'all_articles' => $all_articles,
            'images' => $images,
        ));
	}

	public function actionAdmin()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {

	        $cats = Category::model()->findAll();
	        $criteria=new CDbCriteria();
	        
	         if ($_GET['cat']) {
	            $cat = Category::model()->findByPk($_GET['cat']);
	            $art_cat = ArticleCategory::model()->findAllByAttributes(array('category_id' => $_GET['cat'] ));
	            $rel_article_ids = array();
	            foreach ($art_cat as $value) {
	            	$rel_article_ids[] = $value->article_id;
	            }
	            $criteria->addInCondition('id', $rel_article_ids);
	        }
            $criteria->order = 'date DESC';
            // $criteria->addSearchCondition('title', '%lorem%' , false,'OR');
            // $criteria->addSearchCondition('content', '%lorem%' , false,'OR');

	        $count=Article::model()->count($criteria);
	        $pages=new CPagination($count);
	        $pages->pageSize=10;
	        $pages->applyLimit($criteria);
	        $articles=Article::model()->findAll($criteria);


	        $this->render('admin', array(
	            'articles' => $articles,
	            'pages' => $pages,
	            'cats' => $cats,
	            'current_cat' => $cat,
	        ));

		} else {
			// throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
			$this->redirect(array('site/login'));
		}
	}


	public function actionCreate() {
			// if ($_POST) {
			// 	echo '<pre>';
			// 		print_r($_POST);
			// 		var_dump(strtotime('2016-06-24'));
			// 		var_dump(str_replace('.', '-', $_POST['date']));
			// 		var_dump(date('Y.m.d H:i', 1466715600));
			// 	echo '</pre>';
			// }
			// $this->render('create');
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {

			if ($_POST) {

				$item = new Article;
				$item->title = $_POST['title'];
				$item->content = $_POST['wysiwyg'];
				$item->preview = $_POST['preview'];
				$item->amount = $_POST['amount'];
				$item->min_amount = $_POST['min_amount'];
				$item->unit = $_POST['unit'];
				$item->price = $_POST['price'];
				$item->date = strtotime(str_replace('.', '-', $_POST['date']));
				$item->publish = ($_POST['publish'])? 1 : 0;
				$item->save();

				if ($_FILES){
					//пролистываем весь массив изображений по одному $_FILES['files']['name'] as $k=>$v
					foreach ($_FILES['files']['name'] as $k=>$v)
					{
					    //директория загрузки
					    $uploaddir = "images/product/";
					    //новое имя изображения
					    $name=$item->id.'-'.date('YmdHis').rand(100,1000).'.png';
					    //путь к новому изображению
					    $uploadfile = "$uploaddir$name";
			
				        //перемещаем файл из временного хранилища
				        move_uploaded_file($_FILES['files']['tmp_name'][$k], $uploadfile);
					    
					} //foreach
				} //if files


				if ($_POST['category']) {
					foreach ($_POST['category'] as $value) {
						$rel = new ArticleCategory;
						$rel->article_id = $item->id;
						$rel->category_id = $value;
						$rel->save();
					}
				}

				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
					$this->redirect(array('article/admin/'));
				}
			}
			$this->render('create');
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}


	public function actionEdit($id)
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Article::model()->findByPk($id);
			if ($_POST) {
				$item->title = $_POST['title'];
				$item->content = $_POST['wysiwyg'];
				$item->preview = $_POST['preview'];
				$item->amount = $_POST['amount'];
				$item->min_amount = $_POST['min_amount'];
				$item->unit = $_POST['unit'];
				$item->price = $_POST['price'];
				$item->date = strtotime(str_replace('.', '-', $_POST['date']));
				$item->publish = ($_POST['publish'])? 1 : 0;
				$item->save();

				if ($_FILES){
					//пролистываем весь массив изображений по одному $_FILES['files']['name'] as $k=>$v
					foreach ($_FILES['files']['name'] as $k=>$v)
					{
					    //директория загрузки
					    $uploaddir = "images/product/";
					    //новое имя изображения
					    $name=$item->id.'-'.date('YmdHis').rand(100,1000).'.png';
					    //путь к новому изображению
					    $uploadfile = "$uploaddir$name";
					 
				        //перемещаем файл из временного хранилища
				        move_uploaded_file($_FILES['files']['tmp_name'][$k], $uploadfile);
					    
					} //foreach
				} //if files

				ArticleCategory::model()->deleteAllByAttributes(array('article_id' => $item->id));
				if ($_POST['category']) {
					foreach ($_POST['category'] as $value) {
						$rel = new ArticleCategory;
						$rel->article_id = $item->id;
						$rel->category_id = $value;
						$rel->save();
					}
				}

				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
					$this->redirect(array('article/admin/'));
				}
			}

			$files = glob('images/product/'.$item->id.'-*');
			$images = array();
			if ($files) {
				foreach ($files as $filename) {
				    $images[] = $filename;
				}
			}
			$this->render('edit', array('item' => $item, 'images' => $images, ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}


	public function actionItemDelete()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			if ($_POST) {
				$item = $_POST['classname']::model()->findByPk($_POST['item']);
				$item->delete();
			}
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	
	public function actionImgRemove()
	{
		unlink($_POST['filename']);
	}


}