<h1>Сброс пароля</h1>
<p>На указаный электронный адрес <?php echo $_GET['mail']; ?> выслано сообщение для сброса пароля.</p>
<p>Если сообщение не получено, пожалуйста проверьте папки "Спам" и "Корзина"</p>
<form action="<?php echo Yii::app()->createUrl('customer/forgotpass'); ?>" method="post">
    <input type="hidden" name="mail" value="<?php echo $_GET['mail']; ?>">
    <button type="submit" class="btn btn-primary">Выслать сообщение еще раз</button>
</form>
<div class="vertical-span"></div>