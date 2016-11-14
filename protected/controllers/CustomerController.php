<?php

class CustomerController extends Controller
{

	public function actionIndex()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
	        // $criteria=new CDbCriteria();
	        $criteria=new CDbCriteria(array('order'=>'name ASC'));
	        $count=Customer::model()->count($criteria);
	        $pages=new CPagination($count);
	        $pages->pageSize=30;
	        $pages->applyLimit($criteria);
	        $users = Customer::model()->findAll($criteria);

	        $this->render('index', array(
	            'pages' => $pages,
	            'users' => $users,
	        ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}




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

	public function actionLogin(){		
		$this->layout='//layouts/article';
		$message = '';
		if ($_POST) {			
	        $pass = $_POST['pass'];
	        $user = Customer::model()->findByAttributes(array('password' => $pass));
	        if ($user) {
	        	Yii::app()->user->id = $user->id;
	        	Yii::app()->user->name = $user->name;
	      	    $this->redirect(array('customer/profile/'.$user->id));
	        } else {
    			$message = 'Пароль не верен.';
	        }
		}
        // echo $user->name;

        $this->render('login', array('message' => $message));
    }


	public function actionRegistration(){
		$this->layout='//layouts/article';
			if ($_POST) {
				$user = new Customer;
				$user->name = $_POST['name'];
				$user->phone = $_POST['phone'];
				$user->mail = $_POST['mail']; //проверить на уникальность
				$user->password = $_POST['pass1'];
				$user->save();

				Yii::app()->user->id = $user->id;
				Yii::app()->user->name = $user->name;
				$this->redirect(array('customer/profile/'.$user->id));
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
				if ($_POST['pass'] == $user->password) {
					$user->password = $_POST['pass2'];
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

        public function actionDelete(){
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
	        Customer::model()->deleteByPk($_POST['id']);
            Order::model()->deleteAllByAttributes(array('customer_id' => $_POST['id']));
	        echo 'ok';
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
    }


}