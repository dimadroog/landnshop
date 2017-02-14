    <form id="cp_form" action="" method="post">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Изменить пароль</h2>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="control-label" for="id_pass1">Старый пароль: <span class="text-danger">*</span></label>
                <input class="form-control required" type="password" id="id_pass1" name="pass1" value="">
            </div>  
            <div class="form-group">
                <label class="control-label" for="id_pass2">Новый пароль: <span class="text-danger">*</span></label>
                <input class="form-control required" type="password" id="id_pass2" name="pass2" value="">
            </div>       
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <p id="pass_error" class="text-danger error"><?php echo $message; ?></p>
        </div>
    </div>
</form>

<script type="text/javascript">
    jQuery("#cp_form").submit(function(e){

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

        if (state == 'fail'){
            jQuery('#error').prepend('<br><b>Ошибки:</b>');
            location.hash = 'error';
            return false;
        }
        // c(state);
      });
</script>