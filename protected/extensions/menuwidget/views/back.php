<nav class="navbar <?php echo Setting::getData('navbar_position'); ?> <?php echo Setting::getData('navbar_theme'); ?>">
	<div class="container">
	    <div class="container-fluid">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand"  href="<?php echo Yii::app()->createUrl('/site/index'); ?>"><?php echo Setting::getData('sitename'); ?></a>
	        </div>

	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            <ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Быстрый переход <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo Yii::app()->createUrl('/site/admin') ?>">Админка</a></li>
							<li><a href="<?php echo Yii::app()->createUrl('/article/admin') ?>">Товары</a></li>
							<li><a href="<?php echo Yii::app()->createUrl('/category/admin') ?>">Категории</a></li>
							<li><a href="<?php echo Yii::app()->createUrl('/block/admin') ?>">Блоки</a></li>
							<li><a href="<?php echo Yii::app()->createUrl('/site/seo') ?>">Seo данные</a></li>
							<li><a href="<?php echo Yii::app()->createUrl('/setting/index') ?>">Настройки сайта</a></li>
						</ul>
					</li>
	            </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (Yii::app()->user->id): ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Yii::app()->user->name; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php if (Yii::app()->user->name == 'admin' || Yii::app()->user->name == 'superadmin'): ?>
                                        <li><a href="<?php echo Yii::app()->createUrl('/site/admin/'); ?>">Админка</a></li>
                                        <li><a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">Выйти</a></li>
                                    <?php else: ?>
                                    <li><a href="<?php echo Yii::app()->createUrl('/customer/profile/'.Yii::app()->user->id); ?>">Профиль</a></li>
                                    <li><a href="<?php echo Yii::app()->createUrl('/order/cartlist'); ?>">Корзина</a></li>
                                    <li><a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">Выйти</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    <?php else: ?>
                        <li><a href="<?php echo Yii::app()->createUrl('/customer/login'); ?>">Вход</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('/customer/registration'); ?>">Регистрация</a></li>
                    <?php endif; ?>

                </ul>
	        </div><!-- /.navbar-collapse -->
	    </div><!-- /.container-fluid -->
	</div>
</nav>