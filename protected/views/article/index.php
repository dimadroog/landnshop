<?php 
    if ($_GET['cat']) {
        $title = 'Товары сайта '.Setting::getData('sitename').'. Категория - '.Category::name($_GET['cat']);
        $description = 'Товары категории - '.Category::name($_GET['cat']).'. '.Setting::getData('seo_description');
        $keywords = Category::name($_GET['cat']).', '.Setting::getData('seo_keywords');
    } else {
        $title = 'Товары сайта '.Setting::getData('sitename').'. Весь каталог сайта ';
        $description = 'Весь каталог сайта '.Setting::getData('sitename').'. '.Setting::getData('seo_description');
        $keywords = Setting::getData('seo_keywords');
    }
    $this->pageTitle = $title;
    Yii::app()->clientScript->registerMetaTag($description , description);
    Yii::app()->clientScript->registerMetaTag($keywords , keywords);
?>

<h1>Каталог сайта <?php echo Setting::getData('sitename'); ?></h1>





        <?php if (!$articles): ?>
            <h3 class="text-muted">Пока нет товаров</h3>
            <?php if ($_GET['search']): ?>
                <p class="text-muted">По Вашему запросу "<span class="text-warning"><?php echo $_GET['search']; ?></span>" ничего не найдено.</p>  
                <p class="text-muted">Убедитесь в правильности поисковой фразы или перейдите в раздел <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">все товары</a>.</p>
            <?php endif; ?>
        <?php endif; ?>



        <form action="<?php echo Yii::app()->createUrl('/article/index'); ?>" class="" role="search">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Найти" name="search" value="<?php echo ($_GET['search'])?$_GET['search']:""; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;Поиск</button>
                    </div>      
                </div>
            </div>
        </form>

        <?php if ($_GET['search'] && $articles): ?>
                <p class="text-muted">Результаты по запросу "<span class="text-warning"><?php echo $_GET['search']; ?></span>"</p>
                <p class="text-muted">Результатов: <?php echo count($articles); ?></p>  
        <?php endif; ?> 



<br>

<div class="row">
    <?php if (Category::tree()): ?>
        <div class="col-sm-9">
            <ol class="breadcrumb">
                <li><a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">Все категории</a></li>
                <?php if ($current_cat->id): ?> 
                    <?php foreach (Category::arrNames($current_cat->id) as $id => $name): ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>?cat=<?php echo $id; ?>"><?php echo $name; ?></a>
                        </li>
                    <?php endforeach ?>
                <?php endif ?>
            </ol>
    <?php else: ?>
        <div class="col-sm-12">
    <?php endif ?>
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



        <div class="text-center">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header' => '',
                'firstPageLabel' => '&laquo;',
                'lastPageLabel' => '&raquo;',
                'nextPageLabel' => '&rsaquo;',
                'prevPageLabel' => '&lsaquo;',
                'selectedPageCssClass' => 'active',
                'maxButtonCount' => '3',
                'htmlOptions' => array('class' => 'pagination'),
            )); ?>
        </div>

    </div>
    <?php //var_dump($item); ?>
    <?php if (Category::tree()): ?>
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
    <?php endif; ?>
</div>