<h2>Редактировать данные</h2>
<p><a href="<?php echo Yii::app()->createUrl('/setting/changepassword/'); ?>">Сменить пароль</a></p>
<form action="" onsubmit="return CheckRequired()" method="post">
	<div class="form-group">
		<label class="control-label" for="sitename">Имя сайта<span class="text-danger">*</span></label>
		<input type="text" id="sitename" class="form-control required" name="sitename" value="<?php echo $item->sitename; ?>">
	</div>

    <div class="form-group">
        <label class="control-label" for="email">Email для блока контактов <span class="text-danger">*</span></label>
        <input type="email" id="email" class="form-control required" name="email" value="<?php echo $item->email; ?>">
    </div>

	<div class="form-group">
		<label class="control-label" for="navbar_position">Положение меню<span class="text-danger">*</span></label>
		<select class="form-control" name="navbar_position">
			<option <?php echo ($item->navbar_position == 'navbar-fixed-top')?'selected':'' ?> value="navbar-fixed-top">Всегда видно</option>
			<option <?php echo ($item->navbar_position == 'navbar-static-top')?'selected':'' ?> value="navbar-static-top">Исчезает при прокрутке</option>
		</select>
	</div>
	
	<div class="form-group">
		<label class="control-label" for="navbar_theme">Цветовая схема меню<span class="text-danger">*</span></label>
		<select class="form-control" name="navbar_theme">
			<option <?php echo ($item->navbar_theme == 'navbar-default')?'selected':'' ?> value="navbar-default">По умолчанию</option>
			<option <?php echo ($item->navbar_theme == 'navbar-inverse')?'selected':'' ?> value="navbar-inverse">Инвертная</option>
		</select>
	</div>

	<div  id="hidden_field"  class="form-group">
		<!-- <div  id="hidden_field"  class="form-group dn"> -->
		<label class="control-label" for="bootstrap_theme">Тема оформления <span class="text-danger">*</span></label>
		<select class="form-control" name="bootstrap_theme">
			<option selected value="<?php echo $theme_value; ?>"><?php echo $theme_title; ?></option>
			<option value="bootstrap.min">Default</option>
			<option value="bootstrap_yeti">Yeti</option>
			<option value="bootstrap_cosmo">Cosmo</option>
			<option value="bootstrap_journal">Journal</option>
			<option value="bootstrap_cerulean">Cerulean</option>
			<option value="bootstrap_flatly">Flatly</option>
			<option value="bootstrap_simplex">Simplex</option>
			<option value="bootstrap_standstone">Standstone</option>
			<option value="bootstrap_united">United</option>
			<option value="bootstrap_readable">Readable</option>
			<option value="bootstrap_cyborg">Cyborg</option>
			<option value="bootstrap_slate">Slate</option>
			<option value="bootstrap_superhero">Superhero</option>
			<option value="bootstrap_darkly">Darkly</option>
		</select>
	</div>

    <div class="form-group">
        <label class="control-label" for="content">Блог</label>
        <div class="checkbox">
            <label>
              <input type="checkbox" name="articles" <?php echo ($item->articles == 1)?'checked':''; ?> > Добавление статей на сайте?
            </label>
        </div>
    </div>

	<button type="submit" class="btn btn-primary">Сохранить</button>
</form>
