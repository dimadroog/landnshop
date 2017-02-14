<?php
// echo '<pre>';
// var_dump($order->id);
// var_dump($order->status);
// var_dump($order->customer->name);
// var_dump($order->json);
// var_dump($order->sum);
// var_dump(date('d.m.Y H:i' , $order->date));
// echo '</pre>'; 
$_GET['id'] = $order->customer->id;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2 class="panel-title">Отчет о заказе</h2>
    </div>
    <div class="panel-body">
        <h2>Заказ <?php echo $order->id.'-'.$order->customer->id.'-'.date('dmy' , $order->date) ?></h2>
        <p>Состояние заказа: <?php echo ($order->status == 1)?'<span class="text-success">Выполнен</span>':'<span class="text-danger">Ожидает выполнения</span>'; ?></p>
        <p>Дата заказа: <?php echo date('d.m.Y H:i' , $order->date); ?></p>
        <p>Итоговая сумма: <?php echo $order->sum; ?></p>
        <br>
        <h4>Детали заказа:</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered"> 
                <thead> 
                    <tr class="bg-primary"> 
                        <th>Название</th> 
                        <th>Ед. изм.</th>
                        <th>Цена</th> 
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr> 
                </thead> 
                <tbody>
                    <?php foreach (json_decode($order->json, true) as $value):?> 
                        <tr> 
                            <td>
                                <a href="<?php echo Yii::app()->createUrl('article/'.$value['id']); ?>"><?php echo $value['title']; ?></a>
                            </td>
                            <td><?php echo $value['unit']; ?></td>
                            <td><?php echo $value['price']; ?></td>
                            <td><?php echo $value['count']; ?></td>
                            <td><?php echo $value['sum']; ?></td>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
