<h2>Сменить пароль</h2>
<?php 
if (Yii::app()->user->hasFlash('error_pass')){
    echo '<div class="panel panel-danger"><div class="panel-body">'.Yii::app()->user->getFlash('error_pass').'</div></div>';
} 
?>
<form action="" onsubmit="return CheckRequired()" method="post">
	<div class="form-group">
		<label class="control-label" for="old_pass">Старый пароль<span class="text-danger">*</span></label>
		<input type="password" id="old_pass" class="form-control required" name="old_pass">
	</div>

	<div class="form-group">
		<label class="control-label" for="new_pass">Новый пароль<span class="text-danger">*</span></label>
		<input type="password" id="new_pass" class="form-control required" name="new_pass">
	</div>

	<button type="submit" class="btn btn-primary">Сохранить</button>
</form>
