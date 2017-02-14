<?php

class OrderController extends Controller
{


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
		$ShoppingList = Yii::app()->LavrikShoppingCart->getShoppingList();
		if ($ShoppingList){
			foreach ($ShoppingList as $item) {
				$prod = Article::model()->findByPk($item['id']);
				if ($prod->amount < $item['count']) {
					$item['count'] = $prod->amount;
					// Yii::app()->LavrikShoppingCart->UpdateCountInBascet($item['id'], $prod->amount);
				}
			}
			$ShoppingList = Yii::app()->LavrikShoppingCart->getShoppingList();
		}

		// exit;
		$user = Customer::model()->findByPk(Yii::app()->user->id);
		$users = Customer::model()->findAll(array('order'=>'name ASC'));
		if ($user) {
			$this->layout='//layouts/customer';
		} else {
			$this->layout='//layouts/article';
		}
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
		Yii::app()->user->setFlash('success', 'Товар удален из корзины');

		$this->redirect(array('order/cartlist')); 
	}

	public function actionAddItem($key)
	{
		$shop_arr = Yii::app()->LavrikShoppingCart->getShoppingList();
		$prod = Article::model()->findByPk($shop_arr[$key]['id']);
		$countplus = $shop_arr[$key]['count'] + 1;
		if ($prod->amount < $countplus) {
			Yii::app()->user->setFlash('error', 'Достигнуто максимальное количество товара');
		} else {		
			Yii::app()->LavrikShoppingCart->UpdateCountInBascet($shop_arr[$key]['id'], $countplus);
			Yii::app()->user->setFlash('success', 'Количество товара увеличено до '.$countplus.' '.$prod->unit);
		}
		$this->redirect(array('order/cartlist')); 
	}

	public function actionRemoveItem($key)
	{
		$shop_arr = Yii::app()->LavrikShoppingCart->getShoppingList();
		$prod = Article::model()->findByPk($shop_arr[$key]['id']);
		$countminus = $shop_arr[$key]['count'] - 1;
		if ($prod->min_amount <= $countminus) {
			Yii::app()->LavrikShoppingCart->UpdateCountInBascet($shop_arr[$key]['id'], $countminus);
			Yii::app()->user->setFlash('success', 'Количество товара уменьшено до '.$countminus.' '.$prod->unit);
		} else {		
			Yii::app()->user->setFlash('error', 'Минимальное количество товара для заказа - '.$prod->min_amount.' '.$prod->unit);
		}
		$this->redirect(array('order/cartlist')); 
	}

	public function actionOrder()
	{
		// admin or customer
		if (Yii::app()->user->name != 'Guest') {
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
			$order->customer_id = $_POST['id'];
			// $order->sum = Yii::app()->LavrikShoppingCart->sum;  //!!!!!!@@@
			$order->sum = $sum;  //!!!!!!@@@
			$order->date = time();
			$order->save();

			// session_start();
			// $_SESSION['order'] = $order->id;
			
			Yii::app()->LavrikShoppingCart->clear();

			$this->redirect(array('order/report/'.$order->id));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}

	public function actionAdmin()
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
	        $pages->pageSize=30;
	        $pages->applyLimit($criteria);
	        $orders=Order::model()->findAll($criteria);

	        $this->render('admin', array(
	            'orders' => $orders,
	            'pages' => $pages,
	            'users' => $users,
	            'current_user' => $user,
	        ));
		} else {
			throw new CHttpException(403, 'У Вас нет прав для просмотра этой страницы.');
		}
	}


	public function actionEdit($id)
	{
		if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin') {
			$order = Order::model()->findByPk($id);
			$users = Customer::model()->findAll();
			$products = Article::model()->findAllByAttributes(array('publish' => 1));
			if ($_POST) {
				$old_json = $order->json;
				if ($_POST['json'] != $old_json) {
					// return amounts to db
					foreach (json_decode($old_json) as $value) {
						$prod = Article::model()->findByPk($value->id);
						if ($prod) {
							$prod->amount = $prod->amount+$value->count;
							$prod->save();									
						}
					}
					// take amounts from db
					foreach (json_decode($_POST['json']) as $value) {
						$prod = Article::model()->findByPk($value->id);
						if ($prod) {
							$prod->amount = $prod->amount-$value->count;
							$prod->save();									
						}
					}
				}

				$order->status = $_POST['status'];
				$order->customer_id = $_POST['customer'];
				$order->date = strtotime(str_replace('.', '-', $_POST['date']));
				$order->sum = $_POST['sum'];
				$order->json = $_POST['json'];
				$order->save();
				
				Yii::app()->user->setFlash('changedata', 'Данные успешно сохранены!');
			    $this->redirect(array('order/admin'));
			}
			$this->render('edit', array('item' => $order,'users' => $users,'products' => $products));
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


	function actionReport($id){
		$this->layout='//layouts/customer';
		// session_start();
		$order = Order::model()->findByPk($id);
		if (!$order) {
		    $this->redirect(array('article/index'));
		} else {
		// 	unset($_SESSION['order']);
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

