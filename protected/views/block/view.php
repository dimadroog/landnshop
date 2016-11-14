<div class="container">
    <h2>Блок "<?php echo $item->name; ?>"</h2>

    <?php 
        if (Yii::app()->user->hasFlash('changedata')){
            echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
        } 
    ?>
    <p><a href="<?php echo Yii::app()->createUrl('/block/edit/'.$item->id); ?>">Редактировать</a></p>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Название:</span>
                </div>
                <div class="col-sm-9">
                    <?php echo $item->name; ?>
                </div>
            </div>
            <hr>
            <?php if (Yii::app()->user->name == 'superadmin'): ?>
                <div class="row">
                    <div class="col-sm-3">
                        <span class="text-muted">Alias:</span>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $item->alias; ?>
                    </div>
                </div>
                <hr>    
            <?php endif ?>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Содержимое блока:</span>
                </div>
                <div class="col-sm-9">
                <a href="#block_preview">Предпросмотр</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Цвет фона:</span>
                </div>
                <div class="col-sm-9">
                    <p>&nbsp;<?php echo ($item->bg_color)?'<span class="label" style="background:'.$item->bg_color.';">'.$item->bg_color.'</span>':'<span class="label label-danger">Нет</span>'; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Фоновое изображение:</span>
                </div>
                <div class="col-sm-9">
                    <p>&nbsp;<?php echo ($item->background)?'<img class="image-admin-prev" src="'.Yii::app()->request->baseUrl.'/images/bg_blocks/'.$item->background.'">':'<span class="label label-danger">Нет</span>'; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Опубликован:</span>
                </div>
                <div class="col-sm-9">
                    <p>&nbsp;<?php echo ($item->publish == 1)?'<span class="label label-success">Да</span>':'<span class="label label-danger">Нет</span>'; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Ссылка в меню:</span>
                </div>
                <div class="col-sm-9">
                    <p>&nbsp;<?php echo ($item->publish_menu == 1)?'<span class="label label-success">Да</span>':'<span class="label label-danger">Нет</span>'; ?></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <span class="text-muted">Порядок отображения:</span>
                </div>
                <div class="col-sm-9">
                    <?php echo $item->weight; ?>
                </div>
            </div>
            <hr>
            <p><a href="<?php echo Yii::app()->createUrl('/block/edit/'.$item->id); ?>">Редактировать</a></p>
        </div>
    </div>
</div>

<div id="block_preview" class="block-content <?php echo $item->animate ?>" style="<?php echo Block::buildStyle($item->id, $key); ?>">
    <div class="container">
            <?php $this->widget('application.extensions.blockwidget.BlockWidget', array('item' => $item)); ?>
    </div>
</div>

