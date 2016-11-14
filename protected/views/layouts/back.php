<?php /* @var $this Controller */ ?>
<title>Админка <?php echo Setting::getData('sitename'); ?></title>

<?php $this->beginContent('//layouts/main'); ?>


<!-- menuwidget -->
<?php $this->widget('application.extensions.menuwidget.MenuWidget', array('layout' => 'back')); ?>




	<div class="container">
		<?php echo $content; ?>
	</div>
<?php $this->endContent(); ?>
