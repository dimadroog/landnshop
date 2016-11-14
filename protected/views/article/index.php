<?php 
    if ($_GET['cat']) {
        $title = 'Статьи сайта '.Setting::getData('sitename').'. Категория - '.Category::name($_GET['cat']);
        $description = 'Материалы категории - '.Category::name($_GET['cat']).'. '.Setting::getData('seo_description');
        $keywords = Category::name($_GET['cat']).', '.Setting::getData('seo_keywords');
    } else {
        $title = 'Статьи сайта '.Setting::getData('sitename').'. Все материалы сайта ';
        $description = 'Все материалы сайта '.Setting::getData('sitename').'. '.Setting::getData('seo_description');
        $keywords = Setting::getData('seo_keywords');
    }
    $this->pageTitle = $title;
    Yii::app()->clientScript->registerMetaTag($description , description);
    Yii::app()->clientScript->registerMetaTag($keywords , keywords);
?>

<h1>Каталог сайта <?php echo Setting::getData('sitename'); ?></h1>





<div class="panel panel-default">
    <div class="panel-body">

        <?php if (!$articles): ?>
            <h3 class="text-muted">Пока нет статей</h3>
            <?php if ($_GET['search']): ?>
                <p class="text-muted">По Вашему запросу "<span class="text-warning"><?php echo $_GET['search']; ?></span>" ничего не найдено.</p>  
                <p class="text-muted">Убедитесь в правильности поисковой фразы или перейдите в раздел <a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">все статьи</a>.</p>
            <?php endif; ?>
        <?php endif; ?>


        <label for="exampleInputEmail1">Поиск по каталогу</label>

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

    </div> 
</div>

<br>

<div class="row">
    <?php if ($item->articleCategory): ?>
        <div class="col-sm-9">
            <ol class="breadcrumb">
                <li><a href="<?php echo Yii::app()->createUrl('/article/index'); ?>">Все статьи</a></li>
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

        <?php foreach ($articles as $item): ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="half-article">
                        <h3><a href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>"><?php echo $item->title; ?></a></h3>
                        <p class="text-muted">Дата: <?php echo date('d.m.Y', $item->date); ?></p>
                        <p><?php echo $item->preview; ?></p>
                        <p class="text-right"><a href="<?php echo Yii::app()->createUrl('/article/view/'.$item->id); ?>">Читать далее</a></p>
                    </div>

                    <div class="half-article">  
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
        <?php endforeach; ?> 



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
    <?php endif; ?>
</div>