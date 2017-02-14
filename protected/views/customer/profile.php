<?php 
if (Yii::app()->user->hasFlash('changedata')){
    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
} 
if (Yii::app()->user->hasFlash('changepass')){
    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changepass').'</div></div>';
} 
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Заказы</h2>
            </div>
            <div class="panel-body">

                <?php foreach ($orders as $order):?> 
                    <div>
                        <p><b>Номер заказа: <a href="<?php echo Yii::app()->createUrl('order/report/'.$order->id); ?>"><?php echo $order->id.'-'.$order->customer->id.'-'.date('dmy' , $order->date) ?></a></b></p>
                        <p>Состояние заказа: <?php echo ($order->status == 1)?'<span class="text-success">Выполнен</span>':'<span class="text-danger">Ожидает выполнения</span>'; ?></p>
                        <p>Дата заказа: <?php echo date('d.m.Y H:i' , $order->date); ?></p>
                        <p>Итоговая сумма: <?php echo $order->sum; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <?php if (!$user->orders): ?>
                    <h2 class="text-muted">Пока нет заказов.</h2>
                    <p><a href="<?php echo Yii::app()->createUrl('article/index'); ?>">В каталог</a></p>
                <?php endif; ?>
            </div>
        </div>