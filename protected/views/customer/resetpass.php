<h1>Новый пароль</h1>
    <form id="rp_form" action="" method="post">
            <div class="form-group">
                <label class="control-label" for="id_pass1">Новый пароль: <span class="text-danger">*</span></label>
                <input class="form-control required" type="password" id="id_pass1" name="pass" value="">
            </div>  
            <div class="form-group">
                <label class="control-label" for="id_pass2">Новый пароль (повторить): <span class="text-danger">*</span></label>
                <input class="form-control required" type="password" id="id_pass2" name="pass2" value="">
            </div>       
            <button type="submit" class="btn btn-primary">Сохранить</button>        
            <p id="pass_error" class="text-danger"><?php echo $message; ?></p>
</form>

<script type="text/javascript">
    jQuery("#rp_form").submit(function(e){

        // e.preventDefault();
        var state = 'ok';
        jQuery('.required').each(function(){
            var field = jQuery(this);
            if (field.val() == '') {
                jQuery('#pass_error').html('<br>Пожалуйста, заполните все необходимые поля');
                field.parent().addClass('has-error'); 
                setTimeout(function() {
                    jQuery(field).parent().removeClass('has-error');   
                    jQuery('#pass_error').html('');
                }, 3000); 
                state = 'fail';  
            };
        });

        var pass1 = jQuery('#id_pass1');
        var pass2 = jQuery('#id_pass2');
        if(pass1.val() != pass2.val()) {
            pass1.parent().addClass('has-error'); 
            pass2.parent().addClass('has-error'); 
            // pass1.val(''); 
            // pass2.val(''); 
            jQuery('#pass_error').append('<br>Пароли не совпадают');
            setTimeout(function() {
                jQuery(pass1).parent().removeClass('has-error');   
                jQuery(pass2).parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 3000); 
            state = 'fail';     
        };

        if (state == 'fail'){
            jQuery('#error').prepend('<br><b>Ошибки:</b>');
            location.hash = 'error';
            return false;
        }
        // c(state);
      });

</script>