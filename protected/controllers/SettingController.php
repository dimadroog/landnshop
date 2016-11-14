<?php

class SettingController extends Controller
{
	public function actionIndex()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Setting::model()->findByPk(1);
			$theme = $this->selectedTheme($item->bootstrap_theme);
			// $theme = Self::selectedTheme($item->bootstrap_theme);
			$this->render('index', array('item' => $item, 'theme_title'=>$theme['title'],));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	public function actionEdit()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Setting::model()->findByPk(1);
			if ($_POST) {
				$item->sitename = $_POST['sitename'];
				$item->bootstrap_theme = $_POST['bootstrap_theme'];
				$item->navbar_position = $_POST['navbar_position'];
				$item->navbar_theme = $_POST['navbar_theme'];
				$item->email = $_POST['email'];
				$item->articles = ($_POST['articles'])? 1 : 0;
				$item->save();
				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно изменены!');
					$this->redirect(array('setting/index'));
				}
			}
			$theme = $this->selectedTheme($item->bootstrap_theme);
			// $theme = Self::selectedTheme($item->bootstrap_theme);
			$this->render('edit',array('item'=>$item, 'theme_title'=>$theme['title'], 'theme_value'=>$theme['value'], ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	public function actionChangePassword()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Setting::model()->findByPk(1);
			if ($_POST) {
				if (Yii::app()->user->name == 'admin'){
					if ($item->password != md5(sha1(md5($_POST['old_pass'])))) {
						Yii::app()->user->setFlash('error_pass', 'Старый пароль указан не верно!');
						$this->redirect(array('setting/changepassword'));
					} else {
						$item->password = md5(sha1(md5($_POST['new_pass'])));
						$item->save();
					}
				}
				if (Yii::app()->user->name == 'superadmin'){
					if ($item->super_password != md5(sha1(md5($_POST['old_pass'])))) {
						Yii::app()->user->setFlash('error_pass', 'Старый пароль указан не верно!');
						$this->redirect(array('setting/changepassword'));
					} else {
						$item->super_password = md5(sha1(md5($_POST['new_pass'])));
						$item->save();
					}
				}
				if ($item->save()) {
					Yii::app()->user->setFlash('changepass', 'Пароль изменен!');
					$this->redirect(array('setting/index'));
				}
			}
			$this->render('changepassword',array('item'=>$item));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	// public function actionChangePassword()
	// {
	// 	if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
	// 		$item = Setting::model()->findByPk(1);
	// 		if ($_POST) {
	// 			if ($item->password != md5(sha1(md5($_POST['old_pass'])))) {
	// 				Yii::app()->user->setFlash('error_pass', 'Старый пароль указан не верно!');
	// 				$this->redirect(array('setting/changepassword'));
	// 			} else {
	// 				$item->password = md5(sha1(md5($_POST['new_pass'])));
	// 				$item->save();
	// 			}
	// 			if ($item->save()) {
	// 				Yii::app()->user->setFlash('changepass', 'Пароль изменен!');
	// 				$this->redirect(array('setting/index'));
	// 			}
	// 		}
	// 		$this->render('changepassword',array('item'=>$item));
	// 	} else {
	// 		throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
	// 	}
	// }




	public static function selectedTheme($theme){
		switch ($theme) {
		    case 'bootstrap.min':
		        $theme_title = 'Default';
		        $theme_value = 'bootstrap.min';
		        break;
		    case 'bootstrap_yeti':
		        $theme_title = 'Yeti';
		        $theme_value = 'bootstrap_yeti';
		        break;
		    case 'bootstrap_cosmo':
		        $theme_title = 'Cosmo';
		        $theme_value = 'bootstrap_cosmo';
		        break;
		    case 'bootstrap_journal':
		        $theme_title = 'Journal';
		        $theme_value = 'bootstrap_journal';
		        break;
		    case 'bootstrap_cerulean':
		        $theme_title = 'Cerulean';
		        $theme_value = 'bootstrap_cerulean';
		        break;
		    case 'bootstrap_flatly':
		        $theme_title = 'Flatly';
		        $theme_value = 'bootstrap_flatly';
		        break;
		    case 'bootstrap_simplex':
		        $theme_title = 'Simplex';
		        $theme_value = 'bootstrap_simplex';
		        break;
		    case 'bootstrap_standstone':
		        $theme_title = 'Standstone';
		        $theme_value = 'bootstrap_standstone';
		        break;
		    case 'bootstrap_united':
		        $theme_title = 'United';
		        $theme_value = 'bootstrap_united';
		        break;
		    case 'bootstrap_readable':
		        $theme_title = 'Readable';
		        $theme_value = 'bootstrap_readable';
		        break;
		    case 'bootstrap_cyborg':
		        $theme_title = 'Cyborg';
		        $theme_value = 'bootstrap_cyborg';
		        break;
		    case 'bootstrap_slate':
		        $theme_title = 'Slate';
		        $theme_value = 'bootstrap_slate';
		        break;
		    case 'bootstrap_superhero':
		        $theme_title = 'Superhero';
		        $theme_value = 'bootstrap_superhero';
		        break;
		    case 'bootstrap_darkly':
		        $theme_title = 'Darkly';
		        $theme_value = 'bootstrap_darkly';
		        break;
			}
			$result = array('title' => $theme_title, 'value' => $theme_value);
		return $result;
	}



}