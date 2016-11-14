<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- startbootstrap-scrolling-nav -->
<!-- <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/css/scrolling-nav.css" rel="stylesheet"> -->


<!-- menuwidget -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'front')); ?>


<div id="template_content" class="block-content">
    <div class="container">
        <?php echo $content; ?>
    </div>
</div>

<div id="" class="block-content <?php echo Block::getByAlias('footer')->animate ?>" style="<?php echo Block::buildStyle(Block::getByAlias('footer')->id, 1); ?>">
    <div class="container">
            <?php $this->widget('application.extensions.blockwidget.BlockWidget', array('item' => Block::getByAlias('footer'))); ?>
    </div>
</div>

<!-- Scrolling Nav JavaScript -->
<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/jquery.easing.min.js"></script> -->
<!-- <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/scrolling-nav.js"></script> -->

<?php $this->endContent(); ?>