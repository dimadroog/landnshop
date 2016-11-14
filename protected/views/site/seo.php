<h2>Seo даннные</h2>
<?php 
if (Yii::app()->user->hasFlash('changedata')){
    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
} 
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">title:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $item->seo_title; ?>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">description:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $item->seo_description; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <span class="text-muted">keywords:</span>
            </div>
            <div class="col-sm-9">
                <?php echo $item->seo_keywords; ?>
            </div>
        </div>
        <hr>
        <p><a href="<?php echo Yii::app()->createUrl('/site/seoedit/'); ?>">Редактировать</a></p>
    </div>
</div>
<p class="text-right"><a href="http://meta-tegi.ru/meta-teg-title.html" target="_blank">Что это такое?</a></p>
