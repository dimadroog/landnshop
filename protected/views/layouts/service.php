<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- startbootstrap-scrolling-nav -->

<!-- menuwidget -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'front')); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
