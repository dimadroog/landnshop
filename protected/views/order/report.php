<?php 

?>
<?php
// echo '<pre>';
// var_dump($_SESSION['order']);
// var_dump($order->id);
// var_dump($order->customer->name);
// var_dump($order->json);
// var_dump($order->sum);
// var_dump(date('d.m.Y H:i' , $order->date));
// var_dump($order->status);
// echo '</pre>'; 
?>
<h1>Заказ обработан успешно.</h1>
<p>Уважаемый пользователь <b><?php echo $order->customer->name; ?></b>, Ваш заказ успешно обработан.</p>
<p>В ближайшее время мы свяжемся с Вами по указанному в заказе номеру телефона, и обсудим время доставки и условия оплаты.</p>

<h3>Детали заказа:</h3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered"> 
            <thead> 
                <tr class="bg-primary"> 
                    <th>Артикул</th> 
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
                        <td><?php echo $item['count']; ?> <?php echo $item['unit']; ?></td>
                        <td><?php echo $item['sum']; ?></td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>





<h4 class="text-prymary">Итоговая сумма*: <b><?php echo $order->sum; ?></b></span></h4>
<p class="text-muted">*Итоговая сумма могла быть пересчитана, вследствие изменения остатков на складе во время формирования заказа.</p>
<br>
<p class=""><a href="<?php echo Yii::app()->createUrl('article/index/'); ?>">Вернуться в магазин</a></p>

