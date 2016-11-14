<?php

class OrderController extends Controller
{
	public function actionIndex()
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
	        $users = Customer::model()->findAll();
	        $criteria=new CDbCriteria(array('order'=>'date DESC'));
	        if ($_GET['user']) {
	            $user = Customer::model()->findByPk($_GET['user']);
	            $criteria->addCondition('customer_id=:customer_id');
	            $criteria->params = array(':customer_id'=>$_GET['user']);
	        }

	        $count=Order::model()->count($criteria);
	        $pages=new CPagination($count);
	        $pages->pageSize=10;
	        $pages->applyLimit($criteria);
	        $orders=Order::model()->findAll($criteria);

	        $this->render('index', array(
	            'orders' => $orders,
	            'pages' => $pages,
	            'users' => $users,
	            'current_user' => $user,
	        ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}


	public function actionAddtocart()
	{
		$prod = Article::model()->findByPk($_POST['id']); 
        $amount = $_POST['amount'];
		Yii::app()->LavrikShoppingCart->put($prod, $amount);

		echo '{
			"sum": "'.Yii::app()->LavrikShoppingCart->sum.'",
			"itm": "'.Yii::app()->LavrikShoppingCart->count_of_different_products.'"
		}';
	}



	public function actionCartlist()
	{
		$this->layout='//layouts/article';
		$ShoppingList = Yii::app()->LavrikShoppingCart->getShoppingList();
		$user = Customer::model()->findByPk(Yii::app()->user->id);
		$users = Customer::model()->findAll(array('order'=>'name ASC'));
		$this->render('cartlist', array('cart' => $ShoppingList, 'user' => $user, 'users' => $users, ));
	}


	public function actionClear()
	{
		Yii::app()->LavrikShoppingCart->clear();
		$this->redirect(array('order/cartlist')); 
	}

	public function actionDeleteItem($key)
	{
		Yii::app()->LavrikShoppingCart->DDelFromBasket($key);
		$this->redirect(array('order/cartlist')); 
	}

	public function actionOrder()
	{
    	if (!$_POST['name'] && !$_POST['phone']) {
			throw new CHttpException(403, 'Какая-то непонятная ошибка. К чему бы это?');
		}
		function generatePassword(){
			$consonants = 'bcdfghkmnprstvxz';
			$vowels ='aeiou';
			$arr_vowels = str_split($vowels);
			$arr_consonants = str_split($consonants);
			$str = '';
			for ($i=0; $i<5; $i++) {
				$condition = $i%2;
				if ($condition) {
					$str .= $arr_vowels[array_rand($arr_vowels)];
				} else {
					$str .= $arr_consonants[array_rand($arr_consonants)];
				}
			}
			$str .= rand(1, 9).rand(1, 9);
			return $str;
		}

		// найти или созд. клиента 
		$user = Customer::model()->findByPk($_POST['id']);
		if (!$user){
			$user = new Customer;
			$user->name = $_POST['name'];
			$user->phone = $_POST['phone'];
			$user->password = generatePassword();
			$user->save();
		} else {
			$user->name = $_POST['name'];
			$user->phone = $_POST['phone'];
			$user->save();
		}

		//собираем заказ в json
		$shop_arr = Yii::app()->LavrikShoppingCart->getShoppingList();
		// var_dump($shop_arr);
		// exit;
		$arr_for_json = array();
		$sum = 0;
		foreach ($shop_arr as $item) {
			$prod = Article::model()->findByPk($item['id']);
			if ($prod->amount < $item['count']) {
				$item['count'] = $prod->amount;
			}
			$prod->amount = $prod->amount-$item['count'];
			$prod->save();
			$arr_for_json[] = array(
				'id'=>$prod->id,
				'title'=>$prod->title,
				'price'=>$prod->price,
				'count'=>$item['count'],
				'sum'=>$item['count']*$prod->price,
				'unit'=>$prod->unit,
				);
			$sum += $item['count']*$prod->price;
		}

		// созд. заказ
		$order = new Order;
		$order->json = json_encode($arr_for_json);
		$order->customer_id = $user->id;
		// $order->sum = Yii::app()->LavrikShoppingCart->sum;  //!!!!!!@@@
		$order->sum = $sum;  //!!!!!!@@@
		$order->date = time();
		$order->save();

		session_start();
		$_SESSION['order'] = $order->id;
		
		Yii::app()->LavrikShoppingCart->clear();

		$this->redirect(array('order/report'));
	}

	function actionReport(){
		$this->layout='//layouts/article';
		session_start();
		$order = Order::model()->findByPk($_SESSION['order']);
		if (!$order) {
		    $this->redirect(array('article/index'));
		} else {
			unset($_SESSION['order']);
			$this->render('report', array('order' => $order));
		}
	}


	public function actionChangeStatus(){
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$order = Order::model()->findByPk($_POST['id']);
			if ($order->status == 0) {
				$order->status = 1;
			} else {
				$order->status = 0;
			}
			$order->save();
			echo $order->status;
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}



}

