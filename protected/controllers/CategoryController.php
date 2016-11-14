<?php

class CategoryController extends Controller
{
	public function actionAdmin()
	{
		$this->render('admin');
	}
	public function actionCreate()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {

			if ($_POST) {
				$item = new Category;
				$item->name = $_POST['name'];
				$item->parent_id = $_POST['parent_category'];
				$item->save();
				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
					$this->redirect(array('category/admin/'));
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

			$item = Category::model()->findByPk($id);
			if ($_POST) {
				if ($item->id != $_POST['parent_category']) {
					$item->name = $_POST['name'];
					$item->parent_id = $_POST['parent_category'];
					$item->save();
					Yii::app()->user->setFlash('changedata', 'Данные успешно обновлены!');
					$this->redirect(array('category/admin/'));
				} else {
					Yii::app()->user->setFlash('error', 'Произошла ошибка! Категория не может быть родительской категорией для самой себя');
					$this->redirect(array('category/admin/'));
				}
				
			}
			$selected_parent = Category::model()->findByPk($item->parent_id);	
			$this->render('edit', array('selected_parent' => $selected_parent, 'item' => $item, ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}



	public function actionDelete($id)
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {

				$item = Category::model()->findByPk($id);
				$message = '';
				// delete relations
				$article_categories = ArticleCategory::model()->findAllByAttributes(array('category_id' => $item->id));
				if ($article_categories) {
					foreach ($article_categories as $row) {
						$row->delete();
					}
					$message = ' Некоторые статьи лишились категории';
				}
				// childs to root
				$childs = Category::model()->findAllByAttributes(array('parent_id' => $item->id));
				if ($childs) {
					function fn($childs){
						foreach ($childs as $child) {
							$childs = Category::model()->findAllByAttributes(array('parent_id' => $child->id));
							$child->parent_id = 0;
							$child->save();
							fn($childs);
						}
					}
					fn($childs);
					$message = ' Дочерние категории перемещены в корень каталога.';
				}

				$item->delete();
				Yii::app()->user->setFlash('delete', 'Категория удалена!'.$message);
				$this->redirect(array('category/admin/'));

		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

}