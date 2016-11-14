
    <form id="reg_form" action="" method="post">
 
        <h1>Регистрация</h1>

        <div class="form-group">
            <label class="control-label" for="id_name">Имя: <span class="text-danger">*</span></label>
            <input class="form-control required" type="text" id="id_name" name="name" value="">
        </div>
        <div class="form-group">
            <label class="control-label" for="id_phone">Телефон: <span class="text-danger">*</span></label>
            <input class="form-control required" type="text" id="id_phone" name="phone" value="">
        </div>    
        <div class="form-group">
            <label class="control-label" for="id_mail">EMail: <span class="text-danger">*</span></label>
            <input class="form-control required" type="text" id="id_mail" name="mail" value="">
        </div>      
        <div class="form-group">
            <label class="control-label" for="id_pass1">Пароль: <span class="text-danger">*</span></label>
            <input class="form-control required" type="text" id="id_pass1" name="pass1" value="">
        </div>      
        <div class="form-group">
            <label class="control-label" for="id_pass2">Пароль(повторить): <span class="text-danger">*</span></label>
            <input class="form-control required" type="text" id="id_pass2" name="pass2" value="">
        </div>                       

        <button type="submit" class="btn btn-primary">Сохранить</button>
                
        <div id="error" class="text-danger" style="height: 150px"><?php echo $message; ?></div>
    </form>
<script type="text/javascript">

    jQuery("#reg_form").submit(function(e){
        // e.preventDefault();
        var state = 'ok';
        jQuery('.required').each(function(){
            var field = jQuery(this);
            if (field.val() == '') {
                jQuery('#error').html('<br>Пожалуйста, заполните все необходимые поля');
                field.parent().addClass('has-error'); 
                setTimeout(function() {
                    jQuery(field).parent().removeClass('has-error');   
                    jQuery('#error').html('');
                }, 1500); 
                state = 'fail';  
            };
        });

        var email = jQuery('#id_mail');
        if(!isValidEmailAddress(email.val())) {
            email.parent().addClass('has-error'); 
            jQuery('#error').append('<br>Проверьте введенный Email');
            setTimeout(function() {
                jQuery(email).parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 1500); 
            state = 'fail';     
        };

        var pass1 = jQuery('#id_pass1');
        var pass2 = jQuery('#id_pass2');
        if(pass1.val() != pass2.val()) {
            pass1.parent().addClass('has-error'); 
            pass2.parent().addClass('has-error'); 
            pass1.val(''); 
            pass2.val(''); 
            jQuery('#error').append('<br>Пароли не совпадают');
            setTimeout(function() {
                jQuery(email).parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 1500); 
            state = 'fail';     
        };

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