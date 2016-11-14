<h1>Управление блоками</h1>
<p><a class="" href="<?php echo Yii::app()->createUrl('/block/create/'); ?>">Создать новый блок</a></p>
<?php foreach ($blocks as $key => $block): ?>  
    <div class="panel panel-default item">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">  
                    <p>Блок: <a href="<?php echo Yii::app()->createUrl('/block/view/'.$block->id); ?>"><?php echo $block->name; ?></a></p>
                    <p class="text-muted">Опубликован: <?php echo ($block->publish == 1)?'<span class="label label-success">Да</span>':'<span class="label label-danger">Нет</span>'; ?></p>
                    <p class="text-muted">
                    Порядок: <?php echo $block->weight; ?>
                    <?php if ($key != 0): ?>
                        <a title="Поднять выше" href="<?php echo Yii::app()->createUrl('/block/weightup/'.$block->id); ?>"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>
                    <?php endif; ?>
                    <?php if ($key != count($blocks)-1): ?>
                        <a title="Опустить ниже" href="<?php echo Yii::app()->createUrl('/block/weightdown/'.$block->id); ?>"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                    <?php endif; ?>
                    </p>
                </div>
                <div class="col-sm-6 right-to-left">  
                    <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/block/view/'.$block->id); ?>">Просмотреть</a>
                    <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/block/edit/'.$block->id); ?>">Редактировать</a>
                    <?php if ($block->alias == 'plain' || Yii::app()->user->name == 'superadmin'): ?>
                        <a class="btn btn-xs btn-danger" onclick="ItemDelete(this, '<?php echo get_class($block); ?>', <?php echo $block->id; ?>, '<?php echo Yii::app()->createUrl('/block/itemdelete/'); ?>', 'true')">Удалить</a>
                    <?php endif; ?>

                    
                    <!-- book or contact csv  -->
                    <?php if ($block->alias == 'book' || $block->alias == 'contact' ): ?>
                        <a class="btn btn-xs btn-success" href="<?php echo Yii::app()->createUrl('/site/getcsv/'); ?>" target="_blank">contacts.csv</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>