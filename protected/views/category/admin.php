<h1>Управление категориями</h1>
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
<p><a href="<?php echo Yii::app()->createUrl('/category/create/'); ?>">Создать новую категорию</a></p>

<div class="panel panel-default">
    <div class="panel-body">
    <?php foreach (Category::tree() as $item): ?>
    	<div class="category-admin" style="margin-left:<?php echo $item['level']*25; ?>px">
            <p>
                <div class="row">
                    <div class="col-sm-6 category-item-admin">
                        <?php echo $item['name']; ?>
                    </div>
                    <div class="col-sm-6 right-to-left">
                        <a class="btn btn-xs btn-warning" href="<?php echo Yii::app()->createUrl('/category/edit/'.$item['id']); ?>">Редактировать</a>
                        <a class="btn btn-xs btn-danger" href="<?php echo Yii::app()->createUrl('/category/delete/'.$item['id']); ?>"onclick="return confirm('Дочерние категории будут перемещены в корень каталога')">Удалить</a>
                    </div>
                </div>
            </p>
    	</div>
    <?php endforeach; ?>
    <?php if (!Category::Tree()): ?>
        Нет ни одной категории
    <?php endif ?>	
	</div>
</div>




<?php  
// echo '<pre>';
//     print_r(Category::arrNames(28)); 
//     print_r(Category::tree(true)); 
// echo '</pre>';
?>

