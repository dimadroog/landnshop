<?php 
$params = array(
    'condition'=>'publish=1',
    'order'=>'date DESC',
    'limit' => 6,
	);
$articles = Article::model()->findAll($params); 
?>

<?php echo $item->content; ?>
<div class="row">    
    <?php foreach ($articles as $item): ?>
        <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-body">
                        <a href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>"><h3 class="clip-prev-title"><?php echo $item->title; ?></h3></a>
                
                            <a href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>"><div style="background-image: url(<?php echo Yii::app()->request->baseUrl.'/'.Article::getFirstImage($item->id); ?>);" class="item-prev-img"></div></a>
                   
                        <div class="article-content">
                            
                            <p>
                                <span class="text-success price"><?php echo $item->price; ?></span> 
                                <span class="text-muted">р / <?php echo $item->unit; ?></span>
                            </p>

                            <?php if ($item->amount > $item->min_amount): ?>
                                

                            <p class="text-muted">Минимальный заказ: <?php echo $item->min_amount.' '.$item->unit; ?></p>
<!-- form -->
                            <form name="addtocart">
                                <div class="form-group">
                                    <div class="size-row">
                                        <input class="size-inp-showcase" type="number" name="amount" id="amount" value="<?php echo $item->min_amount;?>" size="20" min="<?php echo $item->min_amount; ?>" max="<?php echo $item->amount; ?>"> 
                                            <span class="text-muted ml5">
                                                <span class="available">Доступно: </span>
                                                <span id="amount-hint"><?php echo $item->amount; ?></span>
                                                <?php echo $item->unit; ?>
                                            </span>
                                    </div>
                                </div>
                                <p>
                                    <a id="<?php echo $item->id; ?>" class="btn btn-primary" onClick="AddToCart(this, '<?php echo Yii::app()->createUrl('order/addtocart/'); ?>');">В корзину</a>
                                </p>
                                <div id="error"></div>
                            </form>
<!-- /form -->
                            <?php else: ?>
                                <p class="text-danger">Товара нет в наличии</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
        </div> <!-- col-sm-4 -->
       
        <?php endforeach; ?> 
</div>



<?php if (!$articles): ?>
    <h3 class="text-muted">Пока нет товаров</h3>
<?php endif; ?>

<p>
    <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">Перейти в каталог</a>
</p>