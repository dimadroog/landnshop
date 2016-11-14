<style type="text/css">
.has-error input, .has-error textarea{
    background-color: #FFBBBB;
    transition: 0.5s;
}
#book_error{
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
#book_success{
    /*padding: 20px;*/
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


<?php if ($item->content): ?>

	<?php 
		$dom=new DOMDocument();
		$content = mb_convert_encoding($item->content, 'HTML-ENTITIES', "UTF-8");
		$dom->loadHTML($content);
		$links = $dom->getElementsByTagName('a');
	?>


	<?php echo preg_replace('#<a.*>.*</a>#USi', "\\2", $item->content); ?>

	<?php // echo $item->content; ?>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo Yii::app()->createUrl('/site/book/'); ?>" method="post" class="" id="book_form">
                <div class="row">
                    <div class="col-md-7 wow slideInLeft">
                        <div class="form-group">
                            <input type="text" class="form-control book_required" placeholder="Ваше Имя *" id="book_name" name="book_name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control book_required" placeholder="Ваш Email *" id="book_email" name="book_email">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-form-front" value="Скачать книгу" style="display: block; width: 100%;">
                        </div>
            			<div id="book_error" class="text-danger text-center"></div>
                    </div>
                    <div class="col-md-5 wow slideInRight text-center">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/book.png" style="height: 200px; margin: 20px">
                    </div>
                </div>
            </form>
        	<!-- <div id="book_success" class="text-center"> -->
        	<div id="book_success" class="dn text-center">
	        	<div class="panel panel-success">
		        	<div class="panel-body">
		        		<h2><span class="nm"></span>Спасибо за Ваше внимание!</h2>
		            	<?php foreach ($links as $val): ?>
						    <p>Вы можете скачать книгу &laquo;<?php echo $val->textContent; ?>&raquo; <a href="<?php echo $val->getAttribute('href'); ?>" target="_blank">по этой ссылке</a></p>
						<?php endforeach; ?>
		        	</div>
	        	</div>
        	</div>
        </div>
    </div>
<?php endif; ?>



<script type="text/javascript">
    jQuery("#book_form").submit(function(e){
        e.preventDefault();
        var state = 'ok';
        var email = jQuery('#book_email');
        if(!isValidEmailAddress(email.val())) {
            email.parent().addClass('has-error'); 
            jQuery('#book_error').html('Проверьте введенный Email');
            setTimeout(function() {
                jQuery(email).parent().removeClass('has-error');   
                jQuery('#book_error').html('');
            }, 1500); 
            state = 'fail';     
        };
        jQuery('.book_required').each(function(){
            var field = jQuery(this);
            if (field.val() == '') {
                jQuery('#book_error').html('Пожалуйста, заполните все необходимые поля');
                field.parent().addClass('has-error'); 
                setTimeout(function() {
                    jQuery(field).parent().removeClass('has-error');   
                    jQuery('#book_error').html('');
                }, 1500); 
                state = 'fail';  
            };
        });
        if (state == 'fail'){
            return false;
        }
        jQuery.ajax({
            type: 'POST',
            url: jQuery('#book_form').attr('action'),
            data: jQuery('#book_form').serialize(),
            success: function(data){
		        jQuery('#book_form').slideUp(500); 
		        jQuery('#book_success').slideDown(500); 
		        jQuery('#book_success').find('.nm').html(jQuery('#book_name').val()+', '); 
		        jQuery('#book_form')[0].reset();
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


