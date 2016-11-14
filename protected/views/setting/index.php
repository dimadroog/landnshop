<h2>Настройки сайта</h2>
<?php 
if (Yii::app()->user->hasFlash('changedata')){
    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
} 
if (Yii::app()->user->hasFlash('changepass')){
    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changepass').'</div></div>';
} 
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Название сайта:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $item->sitename; ?>
            </div>
        </div>
        <hr>
         
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Email для блока контактов:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $item->email; ?>
            </div>
        </div>
        <hr>
         
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Тема оформления:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $theme_title; ?>
            </div>
        </div>
        <hr> 

        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Положение меню:</span>
            </div>
            <div class="col-sm-9">
                <?php echo ($item->navbar_position == 'navbar-static-top')?'Исчезает при прокрутке':'Всегда видно' ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Цветовая схема меню:</span>
            </div>
            <div class="col-sm-9">
                <?php echo ($item->navbar_theme == 'navbar-default')?'По умолчанию':'Инвертная'; ?>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">Статьи на сайте:</span>
            </div>
            <div class="col-sm-9">
                <?php echo ($item->articles == 1)?'<span class="label label-success">Да</span>':'<span class="label label-danger">Нет</span>'; ?>
            </div>
        </div>
        <hr>
        <p><a href="<?php echo Yii::app()->createUrl('/setting/edit/'); ?>">Редактировать</a></p>
    </div>
</div>
