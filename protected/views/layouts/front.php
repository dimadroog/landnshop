<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<!-- startbootstrap-scrolling-nav -->
<!-- <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/css/scrolling-nav.css" rel="stylesheet"> -->


<!-- menu -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'mainpage')); ?>




<?php echo $content; ?>
    <!-- Scrolling Nav JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/jquery.easing.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/startbootstrap-scrolling-nav/js/scrolling-nav.js"></script>

<?php $this->endContent(); ?>
