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
                        <p>Дата заказа <?php echo date('d.m.Y H:i' , $order->date); ?></p>
                        <p>Итоговая сумма: <?php echo $order->sum; ?></p>
                        <p>Состояние заказа: <?php echo ($order->status == 1)?'<span class="text-success">Выполнен</span>':'<span class="text-danger">Ожидает выполнения</span>'; ?></p>
                        <p><a onclick="CollapseTable(this)">Развернуть</a></p>

                        <div id="collapse_tbl" class="table-responsive dn">
                            <table class="table table-hover table-bordered"> 
                                <thead> 
                                    <tr class="bg-primary"> 
                                        <th>Название</th> 
                                        <th>Цена</th> 
                                        <th>Количество</th>
                                        <th>Сумма</th>
                                    </tr> 
                                </thead> 
                                <tbody>
                                    <?php foreach (json_decode($order->json, true) as $item):?> 
                                        <tr>
                                            <td>
                                                <a href="<?php echo Yii::app()->createUrl('article/'.$item['id']); ?>"><?php echo $item['title']; ?></a>
                                            </td> 
                                            <td><?php echo $item['price']; ?></td>
                                            <td><?php echo $item['count']; ?> <?php echo $item['unit']; ?> </td>
                                            <td><?php echo $item['sum']; ?></td>
                                        </tr> 
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <?php if (!$user->orders): ?>
                    <h2 class="text-muted">Пока нет заказов.</h2>
                <?php endif; ?>
            </div>
        </div>




<script type="text/javascript">
    function CollapseTable(elm){
        var tbl = jQuery(elm).parent().parent().find('#collapse_tbl');
        if (tbl.css("display") == "none"){
            tbl.slideDown(200);
            jQuery(elm).html('Свернуть');
        } else {
            tbl.slideUp(200);
            jQuery(elm).html('Развернуть');
        }
    }
</script>