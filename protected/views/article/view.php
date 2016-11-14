<?php 
    $str = '';
    foreach ($item->articleCategory as $value) {
        $str .= $value->name.', ';
    }
    $keywords = $str.Setting::getData('seo_keywords');

    $this->pageTitle = $item->title.' | '.Setting::getData('sitename');
    Yii::app()->clientScript->registerMetaTag(strip_tags($item->preview) , description);
    Yii::app()->clientScript->registerMetaTag($keywords , keywords);
?>

<h1><?php echo $item->title; ?></h1><br>
<div class="row">
    <?php if ($item->articleCategory): ?>
        <div class="col-sm-9">
            <ol class="breadcrumb">
                <li><a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">Все статьи</a></li>
                <?php if ($last_cat->id): ?> 
                    <?php foreach (Category::arrNames($last_cat->id) as $id => $name): ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>?cat=<?php echo $id; ?>"><?php echo $name; ?></a>
                        </li>
                    <?php endforeach ?>
                <?php endif ?>
            </ol>
    <?php else: ?>
        <div class="col-sm-12">
    <?php endif ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if ($images): ?>
                            <ul id="imageGallery">
                                <?php foreach ($images as $value): ?>
                                    <li data-thumb="<?php echo Yii::app()->request->baseUrl.'/'.$value; ?>" data-src="<?php echo Yii::app()->request->baseUrl.'/'.$value; ?>">
                                        <img class="slider-img" src="<?php echo Yii::app()->request->baseUrl.'/'.$value; ?>">
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        <?php else: ?>
                            <img src="<?php echo Yii::app()->request->baseUrl.'/images/product/default.jpg'; ?>" style="width:100%">
                        <?php endif ?>    
                    </div>
                    <div class="col-sm-6">
                        <h3><?php echo $item->title; ?></h3>
                        <div class="article-content">
                            
                            <p class="text-muted">Цена:</p>
                            <p>
                                <span class="text-success price"><?php echo $item->price; ?></span> 
                                <span class="text-muted"> / <?php echo $item->unit; ?></span>
                            </p>
                            <p class="text-muted">Минимальный заказ: <?php echo $item->min_amount.' '.$item->unit; ?></p>
                            <h3 class="">Заказать:</h3>
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
                                <div class="form-group">
                                    <p>
                                        <a id="<?php echo $item->id; ?>" class="btn btn-primary" onClick="AddToCart(this, '<?php echo Yii::app()->createUrl('order/addtocart/'); ?>');">В корзину</a>
                                    </p>
                                    <div id="error"></div>
                                </div>
                            </form>
<!-- /form -->
                            <br>
                            <br>
                            <p class="text-muted">Описание:</p>
                            <p><?php echo $item->content; ?></p>
                        </div>

                        <div class="">    
                            <p>
                            <?php if ($item->articleCategory): ?>
                                <span class="text-muted">Категории: </span>
                                <?php foreach ($item->articleCategory as $value): ?>
                                    <a class="text-muted" href="<?php echo Yii::app()->createUrl('/article/index'); ?>?cat=<?php echo $value['id'] ?>"><?php echo $value->name; ?>;</a>
                                <?php endforeach ?>
                            <?php endif ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if ($item->articleCategory): ?>
        <div class="col-sm-3">
        
            <div class="list-group">
                <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>" class="list-group-item <?php echo($_GET['cat'])?'':'active' ?>">Все категории:</a>
                <?php foreach (Category::tree() as $value): ?>
         
                    <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>?cat=<?php echo $value['id'] ?>" class="list-group-item <?php echo($value['id'] == $_GET['cat'])?'active':'' ?>">
                        <?php echo Category::repeatLevelSymbol($value['level']); ?>
                        <?php echo $value['name']; ?>
                    </a>

                <?php endforeach; ?>
            </div>

        </div>
    <?php endif ?>    

</div>


<?php if ($related_articles): ?>  
    <h3>Похожие товары:</h3>
    <?php foreach ($related_articles as $id => $title): ?>
        <p><a href="<?php echo Yii::app()->createUrl('/article/view/'.$id); ?>"><?php echo $title; ?></a></p>
    <?php endforeach ?>
<?php else: ?>
    <h3>Другие товары:</h3>
    <?php foreach ($all_articles as $value): ?>
        <p><a href="<?php echo Yii::app()->createUrl('/article/view/'.$value->id); ?>"><?php echo $value->title; ?></a></p>
    <?php endforeach ?>
<?php endif ?>
