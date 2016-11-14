<style type="text/css">
.has-error input, .has-error textarea{
    background-color: #FFBBBB;
    transition: 0.5s;
}
#contact_error{
    height: 1px;
}
.form-control, .btn{
    transition: 0.5s;
    height: 60px;
}
.btn{
    text-transform: uppercase;
}
textarea.form-control{
    height: 150px;
}
#contact_success{
    padding: 20px;
    margin: 20px 0;
}

.form-control::-webkit-input-placeholder {
    text-transform: uppercase;
}
.form-control:-moz-placeholder {
    text-transform: uppercase;
}
.form-control::-moz-placeholder {
    text-transform: uppercase;
}
.form-control:-ms-input-placeholder {
    text-transform: uppercase;
}
.nm{
text-transform: capitalize;
}
</style>

<?php echo $item->content; ?>


<div id="contact_success" class="dn text-center panel panel-success">
    <div class="panel-body">
        <h2><span class="nm"></span>Спасибо за Ваше обращение!</h2>
        <p class="text-muted"><i>Мы свяжемся с Вами как можно скорее.</i></p>
    </div>
</div>

<?php // if ($contacts->mail):?>
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo Yii::app()->createUrl('/site/contact/'); ?>" method="post" class="" id="contact_form">
                <div class="row">
                    <div class="col-md-6 wow slideInLeft">
                        <div class="form-group">
                            <input type="text" class="form-control contact_required" placeholder="Ваше Имя *" id="contact_name" name="contact_name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ваш Телефон" id="contact_phone" name="contact_phone">
                            
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control contact_required" placeholder="Ваш Email *" id="contact_email" name="contact_email">
                        </div>
                    </div>
                    <div class="col-md-6 wow slideInRight">
                        <div class="form-group">
                            <textarea class="form-control contact_required" placeholder="Текст сообщения *" id="contact_message" name="contact_message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-form-front" value="Отправить сообщение" style="display: block; width: 100%;">
                        </div>
                    </div>
                </div>
            </form>
            <div id="contact_error" class="text-danger text-center"></div>
        </div>
    </div>
<?php // endif; ?>



<script type="text/javascript">
    jQuery("#contact_form").submit(function(e){
        e.preventDefault();
        var state = 'ok';
        var email = jQuery('#contact_email');
        if(!isValidEmailAddress(email.val())) {
            email.parent().addClass('has-error'); 
            jQuery('#contact_error').html('Проверьте введенный Email');
            setTimeout(function() {
                jQuery(email).parent().removeClass('has-error');   
                jQuery('#contact_error').html('');
            }, 1500); 
            state = 'fail';     
        };
        jQuery('.contact_required').each(function(){
            var field = jQuery(this);
            if (field.val() == '') {
                jQuery('#contact_error').html('Пожалуйста, заполните все необходимые поля');
                field.parent().addClass('has-error'); 
                setTimeout(function() {
                    jQuery(field).parent().removeClass('has-error');   
                    jQuery('#contact_error').html('');
                }, 1500); 
                state = 'fail';  
            };
        });
        if (state == 'fail'){
            return false;
        }
        jQuery.ajax({
            type: 'POST',
            url: jQuery('#contact_form').attr('action'),
            data: jQuery('#contact_form').serialize(),
            success: function(data){
                jQuery('#contact_form')[0].reset();
                jQuery('#contact_success').slideDown(500); 
                jQuery('#contact_success').find('.nm').html(data+', '); 
                jQuery('.form-control').parent().addClass('has-success'); 

                setTimeout(function() {
                    jQuery('#contact_success').slideUp(500);
                    jQuery('.form-control').parent().removeClass('has-success'); 
                }, 6000); 

            }, 
            error: function(){
                alert('error');
            }
        });
      });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        return pattern.test(emailAddress);
    }
</script>


