<?php 

    $title = 'Профиль пользователя '.Yii::app()->user->name;
    $description = Setting::getData('sitename').'. Профиль пользователя';
    $keywords = Setting::getData('seo_keywords');

    $this->pageTitle = $title;
    Yii::app()->clientScript->registerMetaTag($description , description);
    Yii::app()->clientScript->registerMetaTag($keywords , keywords);
?>

<?php $this->beginContent('//layouts/main'); ?>
<?php
if (!$_GET['id'] && Yii::app()->user->id) {
	$_GET['id'] = Yii::app()->user->id;
} 
?>
<!-- startbootstrap-scrolling-nav -->
<!-- <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/css/scrolling-nav.css" rel="stylesheet"> -->


<!-- menu -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'front')); ?>
<div class="container">
<h1>Профиль пользователя <?php echo Customer::getData($_GET['id'], 'name'); ?></h1>
<br>
<br>
	<div class="row">
		<div class="col-sm-3">
	        <div class="panel panel-default">
	            <div class="panel-body">
			        <p><b><?php echo Customer::getData($_GET['id'], 'name'); ?></b></p>
			        <p>Всего заказов: <?php echo count(Customer::getData($_GET['id'], 'orders')); ?></p>
			        <p>Выполнено: <?php echo Customer::ApplyOrders(Customer::getData($_GET['id'], 'id')); ?></p>
			        <p>Ожидают выполнения: <?php echo Customer::NotApplyOrders(Customer::getData($_GET['id'], 'id')); ?></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/changedata/', array('id'=>Customer::getData($_GET['id'], 'id'))); ?>">Изменить данные</a></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/changepass/', array('id'=>Customer::getData($_GET['id'], 'id'))); ?>">Изменить пароль</a></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/profile/', array('id'=>Customer::getData($_GET['id'], 'id'))); ?>">Заказы</a></p>
			        <p><a href="<?php echo Yii::app()->createUrl('order/cartlist'); ?>">Корзина (<?php echo Yii::app()->LavrikShoppingCart->count_of_different_products; ?>)</a></p>
				</div>
			</div>		
		</div>			
		<div class="col-sm-9">
			<?php echo $content; ?>
		</div>		
	</div>
</div>
    <!-- Scrolling Nav JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/jquery.easing.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/scrolling-nav.js"></script>


<div id="" class="block-content <?php echo Block::getByAlias('footer')->animate ?>" style="<?php echo Block::buildStyle(Block::getByAlias('footer')->id, 1); ?>">
    <div class="container">
            <?php $this->widget('application.extensions.blockwidget.BlockWidget', array('item' => Block::getByAlias('footer'))); ?>
    </div>
</div>



<?php $this->endContent(); ?>
