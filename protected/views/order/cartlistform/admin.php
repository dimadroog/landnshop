            <form action="<?php echo Yii::app()->createUrl('order/order/'); ?>" onsubmit="return CheckRequiredAdmin()" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Выбрать клиента</h2>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label" for="id_select">Клиент: <span class="text-danger">*</span></label>
                            <select class="form-control" type="text" id="id_select" name="id">
                                <option value="" disabled selected>Выбрать</option>
                                <?php foreach ($users as $user):?>
                                    <!-- <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option> -->
                                    <option value="<?php echo $user->id; ?>">
                                        <?php echo $user->name; ?> : <?php echo $user->mail; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>           
                        <button type="submit" class="btn btn-primary">ОФОРМИТЬ ЗАКАЗ</button>
                    </div>
                </div>
            </form>