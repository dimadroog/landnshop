<?php

class BlockController extends Controller
{
	public function actionView($id)
	{
		// $this->layout='//layouts/front';
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$block = Block::model()->findByPk($id);
			$this->render('view', array('item' => $block));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	public function actionCreate()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {

			if ($_POST) {
				$item = new Block;
				$item->name = $_POST['name'];
				$item->alias = $_POST['alias'];
				$item->bg_style = $_POST['bg_style'];
				$item->bg_color = $_POST['bg_color'];
				($_POST['animate'])?$item->animate = $_POST['animate']:$item->animate = '';
				$item->content = $_POST['wysiwyg'];
				if ($_POST['publish']){
					$item->publish = 1;
				}
				if ($_POST['publish_menu']){
					$item->publish_menu = 1;
				}

				$blocks = Block::model()->findAll();
				$weight_block = Block::model()->findByAttributes(array('weight' => $_POST['weight']));
				if ($weight_block) {
					$item->weight = $_POST['weight'];

					$weight_block->weight = count($blocks)+1;
					$weight_block->save();
				} else {
					$item->weight = $_POST['weight'];
				}

				$item->save();
		  		if ($_FILES['image_file']['tmp_name'] && $_POST['image_clear'] == 'allow') {
					$width = $_POST['w'];
					$height = $_POST['h'];
					$folder = 'images/bg_blocks/';
					$filename = 'block'.$item->id.'.png';
					$this->UploadFile($_POST, $_FILES, $width, $height, $folder, $filename); /*image save*/
					$item->background = 'block'.$item->id.'.png';
					$item->save();
				} else {
					$item->background = '';
					$item->save();
				}
				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
					$this->redirect(array('block/view/'.$item->id));
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
			$item = Block::model()->findByPk($id);
			if ($_POST) {
				$item->name = $_POST['name'];
				$item->alias = $_POST['alias'];
				$item->bg_style = $_POST['bg_style'];
				$item->bg_color = $_POST['bg_color'];
				($_POST['animate'])?$item->animate = $_POST['animate']:$item->animate = '';
				$item->content = $_POST['wysiwyg'];
				$item->publish = ($_POST['publish'])? 1 : 0;
				$item->publish_menu = ($_POST['publish_menu'])? 1 : 0;

				$blocks = Block::model()->findAll();
				$weight_block = Block::model()->findByAttributes(array('weight' => $_POST['weight']));
				$weight_block_weight = $weight_block->weight;
				if ($weight_block) {
					$weight_block->weight = $item->weight;
					$item->weight = $weight_block_weight;
					$weight_block->save();
				} else {
					$item->weight = $_POST['weight'];
				}

				$item->save();
				if ($_POST['image_clear'] == 'allow') {
			  		if ($_FILES['image_file']['tmp_name']) {
						$width = $_POST['w'];
						$height = $_POST['h'];
						$folder = 'images/bg_blocks/';
						$filename = 'block'.$item->id.'.png';
						$this->UploadFile($_POST, $_FILES, $width, $height, $folder, $filename); /*image save*/
						$item->background = 'block'.$item->id.'.png';
						$item->save();
					}
				} elseif($_POST['image_clear'] == 'clear') {
					if ($item->background) {
						unlink('images/bg_blocks/'.$item->background);
					}
					$item->background = '';
					$item->save();
				}

				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
					$this->redirect(array('block/view/'.$item->id));
				}
			}

			$bg_style = $this->bgStyle($item->bg_style);
			$block_message = $this->blockMessage($item->alias);
			$this->render('edit', array('item' => $item, 'bg_title' => $bg_style['title'], 'bg_value' => $bg_style['value'], 'block_message' => $block_message, ));
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
		        $filename = $item->background;
		        if ($filename) {
		        	unlink('images/bg_blocks/'.$filename);
		        }

				$dataProvider = new CActiveDataProvider('Block', array(
					'criteria'=>array(
		    			'order'=>'weight ASC',
						),
					));
				$blocks	= $dataProvider->getData();
				foreach ($blocks as $key => $block) {
					$block->weight = $key+1;
					$block->save();
				}
			}
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}
	

	public function actionAdmin()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$dataProvider = new CActiveDataProvider('Block', array(
				'criteria'=>array(
        			'order'=>'weight ASC',
    				),
				));
			$blocks	= $dataProvider->getData();
			$this->render('admin',array('blocks' => $blocks));
		} else {
			// throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
			$this->redirect(array('site/login'));
		}
	}

	
	public function actionWeightUp($id)
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Block::model()->findByPk($id);
			$previous_item = Block::model()->findByAttributes(array('weight' => $item->weight-1));
			$item->weight = $item->weight-1;
			$item->save();
			$previous_item->weight = $previous_item->weight+1;
			$previous_item->save();
			$this->redirect(array('block/admin/'));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}
	
	public function actionWeightDown($id)
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Block::model()->findByPk($id);
			$second_item = Block::model()->findByAttributes(array('weight' => $item->weight+1));
			$item->weight = $item->weight+1;
			$item->save();
			$second_item->weight = $second_item->weight-1;
			$second_item->save();
			$this->redirect(array('block/admin/'));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}
	

	public static function bgStyle($style){
		switch ($style) {
		    case 'background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: top center;':
		        $bg_title = 'Заполнить';
		        $bg_value = 'background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: top center;';
		        break;
		    case 'background-repeat: no-repeat; background-position: top center;':
		        $bg_title = 'Как есть сверху';
		        $bg_value = 'background-repeat: no-repeat; background-position: top center;';
		        break;
		    case 'background-repeat: no-repeat; background-position: bottom center;':
		        $bg_title = 'Как есть снизу';
		        $bg_value = 'background-repeat: no-repeat; background-position: bottom center;';
		        break;
		    case 'background-repeat: no-repeat; background-size: 100%;':
		        $bg_title = 'Ширина 100%';
		        $bg_value = 'background-repeat: no-repeat; background-size: 100%;';
		        break;
		    case '':
		        $bg_title = 'Замостить';
		        $bg_value = '';
		        break;
			}
			$result = array('title' => $bg_title, 'value' => $bg_value);
		return $result;
	}

	public static function blockMessage($alias){
		switch ($alias) {
		    case 'slider':
		        $block_message = 'Это блок слайдера. Просто добавьте нужные изображения в это поле. Учтите, что все исходные изображения слайдера должны иметь одинаковые ширину и высоту';
		        break;
		    case 'slider_full':
		        $block_message = 'Это блок слайдера в полную ширину. Просто добавьте нужные изображения в это поле. Учтите, что все исходные изображения слайдера должны иметь одинаковые ширину и высоту. Не добавляйте ничего кроме изображений.';
		        break;
		    default:
		        $block_message = '';
		        break;
			}
		return $block_message;
	}

	public static function UploadFile($post, $files, $width, $height, $folder, $filename){	
	    if ($post) {
	        if ($files) {
	            if (! $files['image_file']['error']) {
	                if (is_uploaded_file($files['image_file']['tmp_name'])) {
	                    $sTempFileName = $folder.$filename; //куда?
	                    move_uploaded_file($files['image_file']['tmp_name'], $sTempFileName); //из врем папки туда
	                    $src_image = imagecreatefromstring(file_get_contents($sTempFileName)); //исходный ресурс 
                        $dst_image = imagecreatetruecolor($width, $height); //результирующий ресурс 
						// copy and resize part of an image with resampling
                        imagecopyresampled($dst_image, $src_image, 0, 0, (int)$post['x1'], (int)$post['y1'], $width, $height, (int)$post['w'], (int)$post['h']);
                        imagepng($dst_image, $sTempFileName); //пересохраняем с обрезкой
                        imagedestroy($dst_image); // очищаем память
                        imagedestroy($src_image); // очищаем память
	                }
	            }
	        }
	    }
	}

}
