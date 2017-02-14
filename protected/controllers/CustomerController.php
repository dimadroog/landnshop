<?php

class CustomerController extends Controller
{

	public function actionProfile($id){
		$this->layout='//layouts/customer';
		if ((Yii::app()->user->name != 'Guest') || ($id == Yii::app()->user->id) || (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin')) {
			$user = Customer::model()->findByPk($id);
			if (!$user) {
				throw new CHttpException(404, 'Такого пользователя не существует.');
			}
			
			// orders criteria
			$attribs = array('customer_id' => $user->id);
			$criteria = new CDbCriteria(array('order'=>'date DESC'));
			$orders = Order::model()->FindAllByAttributes($attribs, $criteria);

			$this->render('profile', array('user' => $user, 'orders' => $orders));
		} else {
			throw new CHttpException(403, 'Доступ к этой страце запрещен. Страница пользователя не соответствует Вашим авторизацонным данным.');
		}
	}


	public function actionCheckMail(){
		$this->layout='//layouts/article';
		$this->render('checkmail', array('mail' => $_GET['mail']));
	}	


	public function actionForgotpass(){		
		$this->layout='//layouts/article';
		if ($_POST) {			
	        $mail = $_POST['mail'];
	        $user = Customer::model()->findByAttributes(array('mail' => $mail));
	        if ($user) {
                $sitename = Setting::getData('sitename');
                $sitemail = Setting::getData('email');
	        	$recoveryurl = Yii::app()->createAbsoluteUrl('customer/resetpass', array('val' => base64_encode($mail)));
				$subject = 'Сброс пароля на сайте '.Setting::getData('sitename');
	            $body = "Здравствуйте $user->name\r\n"."Для Вашего аккаунта был отправлен запрос на сброс пароля на сайте $sitename\r\n"."Если это сделали не Вы - просто проигнорируйте это сообщение\r\n"."Для того чтобы сбросить пароль - перейдите по ссылке $recoveryurl\r\n";
	            $name='=?UTF-8?B?'.base64_encode($sitename).'?=';
				$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
				$headers="From: $name \r\n".
						"Reply-To: {$sitemail}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-Type: text/plain; charset=UTF-8";
				mail($user->mail, $subject, $body, $headers);


				$this->redirect('checkmail?mail='.$mail);
			} else {
				$message = 'Пользователя с email '.$mail.' не существует';
			}
		}
        $this->render('forgotpass', array('message' => $message));
    }

	public function actionResetPass(){
		$this->layout='//layouts/article';
	        $user = Customer::model()->findByAttributes(array('mail' => base64_decode($_GET['val'])));
			if ($_POST) {
				if ($user){
					$user->password = md5(sha1(md5($_POST['pass2'])));

					$user->save();
		        	Yii::app()->user->id = $user->id;
		        	Yii::app()->user->name = $user->name;
					Yii::app()->user->setFlash('changepass', 'Пароль успешно изменен!');
					$this->redirect(array('customer/profile/'.$user->id));
				} else {
					$message = "Ошибка. Пользователь не найден";
				}
			}		
	        $this->render('resetpass', array('user' => $user, 'message' => $message));
    }

	public function actionLogin(){		
		$this->layout='//layouts/article';
		$message = '';
		if ($_POST) {			
			$pass = md5(sha1(md5($_POST['pass']))); 

	        $mail = $_POST['mail'];
	        $user = Customer::model()->findByAttributes(array('mail'=>$mail, 'password' => $pass));
	        if ($user) {
	        	Yii::app()->user->id = $user->id;
	        	Yii::app()->user->name = $user->name;
	        	if (Yii::app()->LavrikShoppingCart->sum != 0) {
		      	    $this->redirect(array('order/cartlist/'));
	        	} else {
		      	    $this->redirect(array('customer/profile/'.$user->id));
	        	}
	        } else {
    			$message = 'Ошибка. Неверный Email или пароль.';
	        }
		}
        $this->render('login', array('message' => $message));
    }


	public function actionRegistration(){
		$this->layout='//layouts/article';
			if ($_POST) {
        		// var_dump($_POST);
        		// $this->render('registration', array('post' => $_POST));
        		// exit;
				$user = new Customer;
				$user->name = $_POST['name'];
				$user->phone = $_POST['phone'];
				$user->mail = $_POST['mail'];
				$user->password = md5(sha1(md5($_POST['pass1'])));
				$user->position_lt = $_POST['lt'];
				$user->position_lg = $_POST['lg'];
				$user->save();

				Yii::app()->user->id = $user->id;
				Yii::app()->user->name = $user->name;
                
                $sitename = Setting::getData('sitename');
                $sitemail = Setting::getData('email');

				$subject = 'Регистрация на сайте '.Setting::getData('sitename');
	            $body = "Здравствуйте $user->name\r\n"."Вы успешно зарегестрировались на сайте $sitename\r\n"."Имя: $user->name\r\n"."Телефон: $user->phone\r\n"."Email: {$user->mail}\r\n";
	            $name='=?UTF-8?B?'.base64_encode($sitename).'?=';
				$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
				$headers="From: $name\r\n".
						"Reply-To: {$sitemail}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-Type: text/plain; charset=UTF-8";
				mail($user->mail, $subject, $body, $headers);



	        	if (Yii::app()->LavrikShoppingCart->sum != 0) {
		      	    $this->redirect(array('order/cartlist/'));
	        	} else {
		      	    $this->redirect(array('customer/profile/'.$user->id));
	        	}
			}		
	        $this->render('registration', array('user' => $user));
    }

	public function actionChangeData($id){
		$this->layout='//layouts/customer';
        if ((Yii::app()->user->name != 'Guest') || ($id == Yii::app()->user->id) || (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin')) {
	        $user = Customer::model()->findByPk($id);
			if ($_POST) {
				$user->name = $_POST['name'];
				$user->phone = $_POST['phone'];
				$user->mail = $_POST['mail'];
				$user->position_lg = $_POST['lg'];
				$user->position_lt = $_POST['lt'];
				$user->save();
				Yii::app()->user->setFlash('changedata', 'Данные успешно изменены!;');
				$this->redirect(array('customer/profile/'.$user->id));
			}		
	        $this->render('changedata', array('user' => $user));
		} else {
			throw new CHttpException(403, 'Доступ к этой страце запрещен. Страница пользователя не соответствует Вашим авторизацонным данным.');
		}
    }

	public function actionChangePass($id){
		$this->layout='//layouts/customer';
        if ((Yii::app()->user->name != 'Guest') || ($id == Yii::app()->user->id) || (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin')) {
	        $user = Customer::model()->findByPk($id);
			if ($_POST) {
// var_dump(md5(sha1(md5($_POST['pass1']))));
// echo '<br>';
// var_dump($user->password);
// exit;
				if (md5(sha1(md5($_POST['pass1']))) == $user->password) {
					$user->password = md5(sha1(md5($_POST['pass2'])));
					$user->save();
					Yii::app()->user->setFlash('changepass', 'Пароль успешно изменен!');
					$this->redirect(array('customer/profile/'.$user->id));
				} else {
					$message = 'Старый пароль не верен.';
				}
			}		
	        $this->render('changepass', array('user' => $user, 'message' => $message));
		} else {
			throw new CHttpException(403, 'Доступ к этой страце запрещен. Страница пользователя не соответствует Вашим авторизацонным данным.');
		}
    }

	public function actionCheckMailUnique(){
		if ($_POST) {
			$alredyissetcustomer = Customer::model()->findByAttributes(array('mail'=>$_POST['mail']));
			if ($alredyissetcustomer) {
				echo 'fail';
				// throw new CHttpException(500);	
			} else {
				echo 'ok';
			}
		}	
    }


	public function actionAdmin()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
	        // $criteria=new CDbCriteria();
	        $criteria=new CDbCriteria(array('order'=>'name ASC'));
	        $count=Customer::model()->count($criteria);
	        $pages=new CPagination($count);
	        $pages->pageSize=30;
	        $pages->applyLimit($criteria);
	        $users = Customer::model()->findAll($criteria);

	        $this->render('admin', array(
	            'pages' => $pages,
	            'users' => $users,
	        ));
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

}

// $url = "https://maps.googleapis.com/maps/api/geocode/json?language=ru&latlng=48.1486663,38.91825410000001";
// $json = file_get_contents($url);
// $info = json_decode($json);
// var_dump($info->results[0]->formatted_address); 
// var_dump($info);