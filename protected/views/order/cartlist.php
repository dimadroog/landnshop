<h1>Корзина</h1>

<?php 
    if (Yii::app()->user->hasFlash('success')){
        echo '<div class="panel panel-success"><div class="panel-body bg-success">'.Yii::app()->user->getFlash('success').'</div></div>';
    }
    if (Yii::app()->user->hasFlash('error')){
        echo '<div class="panel panel-danger"><div class="panel-body bg-danger">'.Yii::app()->user->getFlash('error').'</div></div>';
    }
?>

<?php if(Yii::app()->LavrikShoppingCart->sum == 0): ?>
    <p class="text-muted vertical-span">Ваша корзина пуста. <a href="<?php echo Yii::app()->createUrl('article/index/'); ?>">Перейти в каталог</a></p>
<?php else: ?>
    <?php       
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>'; 
        // echo '<pre><h1>';
        // var_dump(Yii::app()->user->id);
        // echo '</h1></pre>'; 

    ?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="lightgallery" > 
            <thead> 
                <tr class="bg-primary"> 
                    <th>Название</th> 
                    <th>Ед. изм.</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Действие</th>
                </tr> 
            </thead> 
            <tbody>
                <?php foreach ($cart as $key => $item):?> 
                    <?php $prod = Article::model()->findByPk($item['id']) ?>
                    <tr> 
                        <!-- <th scope="row"><?php echo $prod->title; ?></th> -->
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('article/'.$item['id']); ?>"><?php echo $prod->title; ?></a>
                        </td>
                        <td><?php echo $prod->unit; ?></td>
                        <td><?php echo $prod->price; ?></td>
                        <td>
                            <?php echo $item['count']; ?>
                            <a href="<?php echo Yii::app()->createUrl('order/additem/', array('key'=>$key)); ?>"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a> 
                            <a href="<?php echo Yii::app()->createUrl('order/removeitem/', array('key'=>$key)); ?>"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a> 

                        </td>
                        <td><?php echo $item['count']*$item['price']; ?></td>
                        <td>
                            <a class="" href="<?php echo Yii::app()->createUrl('order/deleteitem/', array('key'=>$key)); ?>">Удалить</a> 
                        </td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <p><a href="<?php echo Yii::app()->createUrl('article/index/'); ?>">Добавить еще товаров</a></p> 
            <p><a href="<?php echo Yii::app()->createUrl('order/clear/'); ?>">Очистить корзину</a></p> 
        </div>
        <div class="col-sm-6">
            <p class="text-right text-muted">Наименований: <span class="cart_itm"><?php echo Yii::app()->LavrikShoppingCart->count_of_different_products; ?></span></p>
            <p class="text-right text-muted">На сумму: <span class="cart_sum"><?php echo Yii::app()->LavrikShoppingCart->sum; ?></span> руб.</p>
        </div>
    </div>
    <hr>
    <h2>Оформить заказ</h2>
    <?php if (Yii::app()->user->id): ?>
        <?php if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin'): ?>
            <?php include('cartlistform/admin.php'); ?>
        <?php else: ?>
            <?php include('cartlistform/user.php'); ?>
        <?php endif; ?>   
    <?php else: ?>
        <?php include('cartlistform/guest.php'); ?>
    <?php endif; ?>
<?php endif; ?>



<script type="text/javascript">
    function CheckRequired(){
        var name = jQuery('#id_name');
        var phone = jQuery('#id_phone');
        var state = 'ok';
        if (name.val() == '') {
            name.parent().addClass('has-error');   
            setTimeout(function() {
                name.parent().removeClass('has-error'); 
            }, 2500); 
            state = 'fail';  
        };
        if (phone.val() == '') {
            phone.parent().addClass('has-error'); 
            setTimeout(function() {
                phone.parent().removeClass('has-error'); 
            }, 2500); 
            state = 'fail';     
        };
        if (state == 'fail') { /*не прошли проверку*/
            return false;
        }
        
    } 

    function CheckRequiredAdmin(){
        var id = jQuery('#id_id');
        if (id.val() == ''){          
            alert('Выбрать пользователя');
            return false;
        };
    }
</script>
