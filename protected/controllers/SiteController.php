<?php

class SiteController extends Controller
{
	public $layout='//layouts/back';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout='//layouts/front';
		$dataProvider = new CActiveDataProvider('Block', array(
			'criteria'=>array(
    			'order'=>'weight ASC',
				),
			));
		$blocks	= $dataProvider->getData();
		$this->render('index',array('blocks' => $blocks));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout='//layouts/service';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionContact() {
		if($_POST){
			$name = $_POST['contact_name'];
			$phone = $_POST['contact_phone'];
			$email = $_POST['contact_email'];
			$message = $_POST['contact_message'];
			$subject = 'Новое письмо с сайта '.Setting::getData('sitename');
            $body = "Новое письмо с сайта\r\n"."Имя: $name\r\n"."Телефон: $phone\r\n"."Email: {$email}\r\n"."Текст сообщения: $message";
            $name='=?UTF-8?B?'.base64_encode($name).'?=';
			$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
			$headers="From: $name <{$email}>\r\n".
					"Reply-To: {$email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
			mail(Setting::getData('email'), $subject, $body, $headers);
			$this->setCsv($_POST['contact_name'], $_POST['contact_email'], $_POST['contact_phone']);
			echo $_POST['contact_name'];
		}
	}


	public function actionBook() {
		if($_POST){
			$name = $_POST['book_name'];
			$email = $_POST['book_email'];
			$phone = '';
			$this->setCsv($name, $email, $phone);
		}
	}


	public static function setCsv($name, $email, $phone) {
		$today = date("d.m.Y, H:i:s");
		$file = 'images/contacts.csv';
		$tofile = "$name;$email;$phone;$today\n";
		$bom = "\xEF\xBB\xBF";
		file_put_contents($file, $bom . $tofile . file_get_contents($file));
	}

	public function actionGetCsv() {
		$file = 'images/contacts.csv';
		header("Content-type: application/x-download");
		header("Content-Disposition: attachment; filename=contacts.csv");
		readfile($file);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/front';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->username=$_POST['LoginForm']['username'];
			$model->password=md5(sha1(md5($_POST['LoginForm']['password'])));
			// $model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
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


	public function actionSeo()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Setting::model()->findByPk(1);
			$this->render('seo',array('item'=>$item));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}


	public function actionSeoEdit()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$item = Setting::model()->findByPk(1);
			if ($_POST) {
				$item->seo_title = $_POST['seo_title'];
				$item->seo_description = $_POST['seo_description'];
				$item->seo_keywords = $_POST['seo_keywords'];
				$item->save();
				if ($item->save()) {
					Yii::app()->user->setFlash('changedata', 'Данные успешно изменены!');
					$this->redirect(array('site/seo'));
				}
			}
			$this->render('seo_edit',array('item'=>$item));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

}