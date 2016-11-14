<h1>Корзина</h1>
<?php if(Yii::app()->LavrikShoppingCart->sum == 0): ?>
    <p class="text-muted">Ваша корзина пуста. <a href="<?php echo Yii::app()->createUrl('article/index/'); ?>">Вернуться в каталог</a></p>
<?php else: ?>
    <?php       
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>'; 
        // echo '<pre>';
        // var_dump(Yii::app()->user->id);
        // echo '</pre>'; 

    ?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="lightgallery" > 
            <thead> 
                <tr class="bg-primary"> 
                    <th>Название</th> 
                    <th>Цена</th> 
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th>Действия</th>
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

                        <td class="text-success"><?php echo $prod->price; ?></td>
                        <td><?php echo $item['count']; ?></td>
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
    <?php if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin'): ?>
        <form action="<?php echo Yii::app()->createUrl('order/order/'); ?>" onsubmit="return CheckRequiredAdmin()" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Выбрать клиента</h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label" for="id_select">Клиент: <span class="text-danger">*</span></label>
                        <select class="form-control" type="text" id="id_select" name="select" onchange="FillInputs(this)">
                            <option value="" disabled selected>Выбрать</option>
                            <?php foreach ($users as $user):?>
                                <!-- <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option> -->
                                <option value='{
                                "id": "<?php echo $user->id; ?>", 
                                "name": "<?php echo $user->name; ?>", 
                                "phone": "<?php echo $user->phone; ?>"
                                }'>
                                    <?php echo $user->name; ?> : <?php echo $user->phone; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input class="form-control" type="hidden" id="id_id" name="id" value="">
                        <input class="form-control" type="hidden" id="id_name" name="name" value="">
                        <input class="form-control" type="hidden" id="id_phone" name="phone" value="">
                    </div>           
                    <button type="submit" class="btn btn-primary">ОФОРМИТЬ ЗАКАЗ</button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <form action="<?php echo Yii::app()->createUrl('order/order/'); ?>" onsubmit="return CheckRequired()" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Данные о заказчике</h2>
                </div>
                <div class="panel-body">
                <p><span class="text-muted"></span><?php echo $user->name; ?></p>
                <p><span class="text-muted"></span><?php echo $user->phone; ?></p>
                <p><span class="text-muted"></span><?php echo $user->mail; ?></p>
                <p><a href="<?php echo Yii::app()->createUrl('customer/changedata/'.$user->id); ?>">Изменить данные</a></p>
                    <div class="form-group">
                        <label class="control-label" for="id_name">Имя и Фамилия: <span class="text-danger">*</span></label>
                        <input class="form-control" type="hidden" id="id_id" name="id" value="<?php echo $user->id; ?>">
                        <input class="form-control" type="text" id="id_name" name="name" value="<?php echo $user->name; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_phone">Телефон: <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="id_phone" name="phone" value="<?php echo $user->phone; ?>">
                    </div>                        

                    <button type="submit" class="btn btn-primary">ОФОРМИТЬ ЗАКАЗ</button>
                </div>
            </div>
        </form>
    <?php endif; //admin ?>
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

    function FillInputs(elm){
        var select_val = jQuery(elm).val();
        var jsondata = jQuery.parseJSON(select_val);
        var id = jQuery('#id_id');
        var name = jQuery('#id_name');
        var phone = jQuery('#id_phone');
        id.val(jsondata.id);
        name.val(jsondata.name);
        phone.val(jsondata.phone);
        // c(jsondata);
    }   

    function CheckRequiredAdmin(){
        var id = jQuery('#id_id');
        if (id.val() == ''){          
            alert('Выбрать пользователя');
            return false;
        };
    }
</script>
