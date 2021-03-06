 <h1>Управление заказами</h1>
 <div class="row">
    <div class="col-sm-9">      

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                Заказы:
                <?php if ($current_user): ?>
                    <a href="<?php echo Yii::app()->createUrl('customer/profile/'.$current_user->id); ?>"><?php echo $current_user->name; ?></a>
                <?php endif; ?>
                </h2>
            </div>
            <div class="panel-body">

                <?php foreach ($orders as $order):?> 
                    <div>

                        <p>Номер заказа: <a href="<?php echo Yii::app()->createUrl('order/report/'.$order->id); ?>"><?php echo $order->id.'-'.$order->customer->id.'-'.date('dmy' , $order->date) ?></a></p>
                        <p>Клиент: <b><a href="<?php echo Yii::app()->createUrl('customer/profile/'.$order->customer->id); ?>"><?php echo $order->customer->name; ?></a></b></p>
                        <p>Дата заказа <?php echo date('d.m.Y H:i' , $order->date); ?></p>
                        <p>Состояние заказа: <?php echo ($order->status == 1)?'<span id="status_span" class="text-success">Выполнен</span>':'<span id="status_span" class="text-danger">Ожидает выполнения</span>'; ?> 
                        <a onclick="ChangeStatus(this, <?php echo $order->id; ?>)"><span class="glyphicon glyphicon-refresh ruble cp ml5" aria-hidden="true"></span></a></p>
                        <!-- btn btn-primary btn-xs -->
                        <p><a onclick="CollapseTable(this)">Развернуть</a></p>

                        <div id="collapse_tbl" class="table-responsive dn">
                        <p>id: <span class=""> <?php echo $order->id; ?></span></p>
                        <p>Телефон: <span class=""> <?php echo $order->customer->phone; ?></span></p>
                        <p>Итоговая сумма: <?php echo $order->sum; ?></p>                            

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
                    <br>
                <?php endforeach; ?>

                <?php if (!$current_user->orders && $current_user): ?>
                    <h2 class="text-muted">У этого клиента нет заказов.</h2>
                <?php endif; ?>

            </div>
        </div>


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
            )) ?>
        </div>


    </div>
    <div class="col-sm-3 showcase">
        <div class="cat-head">
            <a href="<?php echo Yii::app()->createUrl('order/index/'); ?>" class="name-category"><b>Все клиенты</b></a>
        </div>
        <?php foreach ($users as $user): ?>
        <p>
            <a href="<?php echo Yii::app()->createUrl('order/index/', array('user'=>$user->id)); ?>"><?php echo $user->name; ?> (<?php echo Customer::NotApplyOrders($user->id); ?>)</a>
        </p>
        <?php endforeach; ?>
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