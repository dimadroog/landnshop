<h1>Управление сайтом</h1>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6"> 
                <h4><a href="<?php echo Yii::app()->createUrl('/block/admin/'); ?>">Блоки</a></h4>
                <p class="text-muted">Блоки на главной странице сайта</p>
            </div>
            <div class="col-sm-6 right-to-left">  
                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/block/admin/'); ?>">Перейти</a>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6"> 
                <h4><a href="<?php echo Yii::app()->createUrl('/article/admin/'); ?>">Статьи</a></h4>
                <p class="text-muted">Управление статьями сайта</p>
            </div>
            <div class="col-sm-6 right-to-left">  
                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/article/admin/'); ?>">Перейти</a>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6"> 
                <h4><a href="<?php echo Yii::app()->createUrl('/category/admin'); ?>">Категории</a></h4>
                <p class="text-muted">Управление категориями статей</p>
            </div>
            <div class="col-sm-6 right-to-left">  
                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/category/admin/'); ?>">Перейти</a>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6"> 
                <h4><a href="<?php echo Yii::app()->createUrl('/site/seo/'); ?>">SEO данные</a></h4>
                <p class="text-muted">title, description, keywords</p>
            </div>
            <div class="col-sm-6 right-to-left">  
                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/site/seo/'); ?>">Перейти</a>
                <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/site/seoedit/'); ?>">Редактировать</a>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6"> 
                <h4><a href="<?php echo Yii::app()->createUrl('/setting/index'); ?>">Настройки сайта</a></h4>
                <p class="text-muted">Настройки сайта</p>
            </div>
            <div class="col-sm-6 right-to-left">  
                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/setting/index/'); ?>">Перейти</a>
                <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/setting/edit/'); ?>">Редактировать</a>
            </div>
        </div>
    </div>
</div>
