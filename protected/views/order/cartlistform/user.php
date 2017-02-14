            <form action="<?php echo Yii::app()->createUrl('order/order/'); ?>" onsubmit="return CheckRequired()" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Данные о заказчике</h2>
                    </div>
                    <div class="panel-body">
                        <p><span class="text-muted">Имя: </span><?php echo $user->name; ?></p>
                        <p><span class="text-muted">Телефон: </span><?php echo $user->phone; ?></p>
                        <p><span class="text-muted">mail: </span><?php echo $user->mail; ?></p>
                        <p><span class="text-muted">Адрес: </span><?php echo Customer::getAddress($user->id); ?></p>
                        <p><a href="<?php echo Yii::app()->createUrl('customer/changedata/'.$user->id); ?>">Изменить данные</a></p>
                        <input class="form-control" type="hidden" id="id_id" name="id" value="<?php echo $user->id; ?>">                   

                        <button type="submit" class="btn btn-primary">ОФОРМИТЬ ЗАКАЗ</button>
                    </div>
                </div>
            </form>