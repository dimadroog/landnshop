<h2>Вход для клиентов</h2>
<form id="login_form" action="<?php echo Yii::app()->createUrl('customer/login/'); ?>" method="post">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="control-label" for="id_mail">EMail: <span class="text-danger">*</span></label>
                <input class="form-control required" type="text" id="id_mail" name="pass" value="">
            </div>  
            <div class="form-group">
                <label class="control-label" for="id_pass">Пароль: <span class="text-danger">*</span></label>
                <input class="form-control required" type="password" id="id_pass" name="pass" value="">
            </div>       
            <button type="submit" class="btn btn-primary">ВОЙТИ</button>
        </div>
    </div>
    <p id="error" class="text-danger"><?php echo $message; ?></p>
</form>


<script type="text/javascript">

    jQuery("#login_form").submit(function(e){
        // e.preventDefault();
        var state = 'ok';
        var email = jQuery('#id_mail');
        if(!isValidEmailAddress(email.val())) {
            email.parent().addClass('has-error'); 
            jQuery('#error').html('Проверьте введенный Email');
            setTimeout(function() {
                jQuery(email).parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 1500); 
            state = 'fail';     
        };
        jQuery('.required').each(function(){
            var field = jQuery(this);
            if (field.val() == '') {
                jQuery('#error').html('Пожалуйста, заполните все необходимые поля');
                field.parent().addClass('has-error'); 
                setTimeout(function() {
                    jQuery(field).parent().removeClass('has-error');   
                    jQuery('#error').html('');
                }, 1500); 
                state = 'fail';  
            };
        });
        if (state == 'fail'){
            return false;
        }
        c(state);
      });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        return pattern.test(emailAddress);
    }
</script>