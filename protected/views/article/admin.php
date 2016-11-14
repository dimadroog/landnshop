<h1>Управление статьями</h1>

<?php 
	if (Yii::app()->user->hasFlash('changedata')){
	    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('changedata').'</div></div>';
	}
	if (Yii::app()->user->hasFlash('error')){
	    echo '<div class="panel panel-danger"><div class="panel-body">'.Yii::app()->user->getFlash('error').'</div></div>';
	}
	if (Yii::app()->user->hasFlash('delete')){
	    echo '<div class="panel panel-success"><div class="panel-body">'.Yii::app()->user->getFlash('delete').'</div></div>';
	}
?>
<div class="row">
    <div class="col-sm-6 category-item-admin">
        <p><a href="<?php echo Yii::app()->createUrl('/article/create/'); ?>">Создать новую статью</a></p>
    </div>
    <div class="col-sm-6 right-to-left">
        <p>
            <a id="show_all" onclick="ShowAllArticleDetails(this)">Развернуть все</a>
            <a id="hide_all" class="dn" onclick="HideAllArticleDetails(this)">Свернуть все</a>
        </p>
    </div>
</div>

<?php foreach ($articles as $item): ?>
	<div class="panel panel-default item">
	    <div class="panel-body">
	    	<div class="row">
		    	<div class="col-sm-6 category-item-admin">
		    		<a onclick="ToggleArticleDetails(this)"><?php echo $item->title; ?></a>
		    	</div>
		    	<div class="col-sm-6 right-to-left">
	                <a class="btn btn-xs btn-primary" href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>">Перейти</a>
	                <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/article/edit/'.$item->id); ?>">Редактировать</a>
                    <a class="btn btn-xs btn-danger" onclick="ItemDelete(this, '<?php echo get_class($item); ?>', <?php echo $item->id; ?>, '<?php echo Yii::app()->createUrl('/article/itemdelete/'); ?>', 'false')">Удалить</a>
		    	</div>
	    	</div>
            <div class="toggle dn">
	    	<!-- <div class=""> -->
                <p></p>
	    		<p><span class="text-muted">Дата: </span><?php echo date('d.m.Y', $item->date); ?></p>
                <p><span class="text-muted">Опубликован: </span><?php echo ($item->publish == 1)?'<span class="label label-success">Да</span>':'<span class="label label-danger">Нет</span>'; ?></p>
                <p>
                	<span class="text-muted">Категории: </span>
                	<?php foreach ($item->articleCategory as $value): ?>
                		<span class="label label-primary"><?php echo Category::fullName($value->id); ?></span>
                	<?php endforeach ?>
                </p>
                <p><a href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>">Перейти к статье</a></p>


	    	</div>
		</div>
	</div>
<?php endforeach; ?>	
<?php if (!$articles): ?>
	<h3 class="text-muted">Пока нет статей</h3>
<?php endif; ?>


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
            )); ?>
        </div>
