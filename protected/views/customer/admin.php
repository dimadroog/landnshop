<h1>Управление клиентами</h1>

<?php 
	if (Yii::app()->user->hasFlash('changedata')){
	    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
	}
	if (Yii::app()->user->hasFlash('error')){
	    echo '<div class="panel panel-danger"><div class="panel-body">'.Yii::app()->user->getFlash('error').'</div></div>';
	}
	if (Yii::app()->user->hasFlash('delete')){
	    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('delete').'</div></div>';
	}
?>
<div class="row">
    <div class="col-sm-6 category-item-admin">
        <p><a href="<?php echo Yii::app()->createUrl('customer/registration/'); ?>">Регистрация нового клиента</a></p>
    </div>
    <div class="col-sm-6 right-to-left">
        <p>
            <a id="show_all" onclick="ShowAllArticleDetails(this)">Развернуть все</a>
            <a id="hide_all" class="dn" onclick="HideAllArticleDetails(this)">Свернуть все</a>
        </p>
    </div>
</div>

<?php foreach ($users as $item): ?>
	<div class="panel panel-default item">
	    <div class="panel-body">
	    	<div class="row">
		    	<div class="col-sm-6 category-item-admin">
		    		<a onclick="ToggleArticleDetails(this)"><?php echo $item->name; ?></a>
		    	</div>
		    	<div class="col-sm-6 right-to-left">
	                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/customer/profile/'.$item->id); ?>">Перейти</a>
	                <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/customer/changedata/'.$item->id); ?>">Редактировать</a>
                    <a class="btn btn-xs btn-danger" onclick="ItemDelete(this, '<?php echo get_class($item); ?>', <?php echo $item->id; ?>, '<?php echo Yii::app()->createUrl('/customer/itemdelete/'); ?>', 'false')">Удалить</a>
		    	</div>
	    	</div>
            <div class="toggle dn">
	    	<!-- <div class=""> -->
                <p></p>
                <p><span class="text-muted">Телефон: </span><?php echo $item->phone; ?></p>
                <p><span class="text-muted">Email: </span><?php echo $item->mail; ?></p>
                <p><span class="text-muted">Адрес: </span><?php echo Customer::getAddress($item->id); ?></p>
                <p><span class="text-muted">Заказов: </span><?php echo count($item->orders); ?></p>
                <p><span class="text-muted">Общая сумма: </span><?php Customer::TotalSum($item->id); ?></p>
      
                <p><a href="<?php echo Yii::app()->createUrl('/customer/profile/'.$item->id); ?>">Перейти к профилю</a></p>


	    	</div>
		</div>
	</div>
<?php endforeach; ?>	
<?php if (!$users): ?>
	<h3 class="text-muted">Пока нет ничего</h3>
<?php endif; ?>


        <div class="text-center">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header' => '',
                'firstPageLabel' => '<<',
                'lastPageLabel' => '>>',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'selectedPageCssClass' => 'active',
                'maxButtonCount' => '3',
                'htmlOptions' => array('class' => 'pagination'),
            )); ?>
        </div>
