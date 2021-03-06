<h1>Управление заказами</h1>

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
    </div>
    <div class="col-sm-6 right-to-left">
        <p>
            <a id="show_all" onclick="ShowAllArticleDetails(this)">Развернуть все</a>
            <a id="hide_all" class="dn" onclick="HideAllArticleDetails(this)">Свернуть все</a>
        </p>
    </div>
</div>

<?php foreach ($orders as $item): ?>
	<div class="panel panel-default item">
	    <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 category-item-admin">
                    <a onclick="ToggleArticleDetails(this)"><?php echo $item->id.'-'.$item->customer->id.'-'.date('dmy' , $item->date) ?></a>
                    <div>
                        <span class="text-muted">Статус: </span><?php echo ($item->status == 1)?'<span id="status_span" class="text-success">Выполнен</span>':'<span id="status_span" class="text-danger">Ожидает выполнения</span>'; ?> 
                        <a onclick="ChangeStatus(this, <?php echo $item->id; ?>)"><span class="glyphicon glyphicon-refresh ruble cp ml5" aria-hidden="true"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 right-to-left">
                    <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/order/report/'.$item->id); ?>">Перейти</a>
                    <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/order/edit/'.$item->id); ?>">Редактировать</a>
                    <a class="btn btn-xs btn-danger" onclick="ItemDelete(this, '<?php echo get_class($item); ?>', <?php echo $item->id; ?>, '<?php echo Yii::app()->createUrl('/order/itemdelete/'); ?>', 'false')">Удалить</a>
                </div>
            </div>
            <div class="toggle dn">
            <!-- <div class=""> -->
                <p></p>
      
                <p><span class="text-muted">Клиент: </span><a href="<?php echo Yii::app()->createUrl('customer/profile/'.$item->customer->id); ?>"><?php echo $item->customer->name; ?></a></p>
                <p><span class="text-muted">Сумма: </span><?php echo $item->sum; ?></p>
                <p><span class="text-muted">Дата: </span><?php echo date('d.m.Y H:i' , $item->date); ?></p>
                <p><a href="<?php echo Yii::app()->createUrl('/order/report/'.$item->id); ?>">Перейти к отчету</a></p>


	    	</div>
		</div>
	</div>
<?php endforeach; ?>	
<?php if (!$orders): ?>
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



<script type="text/javascript">
    function ChangeStatus(elm, order){
        var lnk = jQuery(elm);
        var span = lnk.parent().find('#status_span')
        c(order);
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl('order/changestatus/'); ?>',
            data: {'id': order},
            success: function(data){
                if (data == 1) {
                    span.removeClass('text-danger');
                    span.addClass('text-success');
                    span.html('Выполнен');
                } else {
                    span.removeClass('text-success');
                    span.addClass('text-danger');
                    span.html('Ожидает выполнения');
                };
            }, 
            error: function(){
                alert('error');
            }
        });
    }
</script>