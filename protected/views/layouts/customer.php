<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!-- startbootstrap-scrolling-nav -->
<!-- <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/css/scrolling-nav.css" rel="stylesheet"> -->


<!-- menu -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'mainpage')); ?>
<div class="container">
<h1>Профиль пользователя <?php echo Customer::getData('name'); ?></h1>
<br>
<br>
	<div class="row">
		<div class="col-sm-3">
	        <div class="panel panel-default">
	            <div class="panel-body">
			        <p><?php echo Customer::getData('name'); ?></span></p>
			        <p>Всего заказов: <?php echo count(Customer::getData('orders')); ?></p>
			        <p>Выполнено: <?php echo Customer::ApplyOrders(Customer::getData('id')); ?></p>
			        <p>Ожидают выполнения: <?php echo Customer::NotApplyOrders(Customer::getData('id')); ?></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/changedata/', array('id'=>Customer::getData('id'))); ?>">Изменить данные</a></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/changepass/', array('id'=>Customer::getData('id'))); ?>">Изменить пароль</a></p>
			        <p><a href="<?php echo Yii::app()->createUrl('customer/profile/', array('id'=>Customer::getData('id'))); ?>">Заказы</a></p>
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

<?php $this->endContent(); ?>
