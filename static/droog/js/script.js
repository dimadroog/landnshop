function c(param){
    return console.log(param);
}
  
jQuery(document).ready(function() {


    /* if .navbar-fixed-top body padding from nav height*/
    if (jQuery('nav').is('.navbar-fixed-top')) {
        jQuery('body').css('padding-top', jQuery('.navbar').css('min-height'));
    };

    /* if .navbar-fixed-top body padding from nav height*/
    // if (jQuery('nav').is('.navbar-fixed-top')) {
    //     var nav_hght = parseInt(jQuery('.navbar').css('min-height'));
    //     var nav_pdt = parseInt(jQuery('.navbar').css('padding-top'));
    //     var nav_pdb = parseInt(jQuery('.navbar').css('padding-bottom'));
    //     var sum = nav_hght+nav_pdt+nav_pdb+'px';
    //     jQuery('body').css({'padding-top':sum});
    //     c(sum);
    // };


    /*scrolltop*/
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 100) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });
    jQuery('.scrollup').click(function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


    /*hotkey*/
    jQuery('html').keydown(function(eventObject){ //отлавливаем нажатие клавиш
        if (event.altKey && event.keyCode == 72){ //если нажали alt + h, то true
            jQuery('#hidden_field').toggle();
        }
    });

    /* #block_preview wihout .container class in //layout/back */
    jQuery('#block_preview').parent().removeClass('container'); 


    /*colorpicker*/
    jQuery(function() {
        jQuery('#colorpicker').colorpicker({
            customClass: 'colorpicker-2x',
            sliders: {
                saturation: {
                    maxLeft: 200,
                    maxTop: 200
                },
                hue: {
                    maxTop: 200
                },
                alpha: {
                    maxTop: 200
                }
            }
        });
    });

    /*select2*/
    jQuery("#select2").select2({
        // placeholder: "",
        allowClear: true
    });

           
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:4,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });

    /*show small cart*/
    if (jQuery('.cart_sum').html() > 0) {
        jQuery('.small-cart').show();
    };


});


function CheckRequired(){
    var state = 'ok';
    jQuery('.required').each(function(){
        var field = jQuery(this);
        if (field.val() == '') {
            field.parent().addClass('has-error');   
            field.focus();   
            setTimeout(function() {
                jQuery(field).parent().removeClass('has-error'); 
            }, 1500); 
            state = 'fail';  
        };
    });
    if (state == 'fail'){
        return false;
    }
}

function ItemDelete(elm, classname, item, url, refresh){
    var sure = confirm("Уделенные данные нельзя будет восстановить. Продолжить?");
    if (sure == true){  
        var lnk = jQuery(elm);
        var div = elm.closest('.item');
        jQuery.ajax({
            type: 'POST',
            url: url,
            data: {'item': item, 'classname': classname, },
            success: function(data){
                c(data);
                jQuery(div).slideUp(500);
                if (refresh == 'true') {
                    setTimeout(function() {
                        location.reload()
                    }, 500); 
                };
            }, 
            error: function(){
                alert('error');
            }
        });
    } else {
        return false;
    }
}

function testAnim() {
    var cls = jQuery('#animate_slct').val()
    jQuery('#animationSandbox').removeClass().addClass(cls + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        jQuery(this).removeClass();
    });
};

function ToggleArticleDetails(elm) {
    jQuery(elm).closest('.panel').find('.toggle').toggle(300);
};

function ShowAllArticleDetails() {
    jQuery('.toggle').each(function(){
        jQuery(this).show(300);
    });
    jQuery('#show_all').hide();
    jQuery('#hide_all').show();
};

function HideAllArticleDetails() {
    jQuery('.toggle').each(function(){
        jQuery(this).hide(300);
    });
    jQuery('#show_all').show();
    jQuery('#hide_all').hide();
};


  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="product-form-thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }
if (document.getElementById('files')) {
  document.getElementById('files').addEventListener('change', handleFileSelect, false);
}



  function RemoveProductImg(elm, url, filename){
    jQuery.ajax({
        type: 'POST',
        url: url,
        data: {'filename': filename},
        success: function(data){
            c(data);
            jQuery(elm).parent().slideUp(500);
        }, 
        error: function(){
            alert('error');
        }
    });
  }


function AddToCart(elm, url){
    var id = jQuery(elm).attr('id');
    var form = jQuery(elm).closest('form');
    var amount = parseInt(jQuery(form).find('#amount-hint').text(), 10);
    var min_amount = parseInt(jQuery(form).find('.size-inp-showcase').attr('min'), 10);
    var val = parseInt(jQuery(form).find('.size-inp-showcase').val(), 10);
    var state = 0;

    if (val > amount){  /*проверка*/
        form.find('#error').html('<p class="text-danger">Нельзя заказать больше товара чем доступно!</p>');
        setTimeout(function() {
            form.find('#error').html('');
        }, 2500);
        state = 'fail';
    } else if (val < min_amount || !val) { /*проверка*/
        form.find('#error').html('<p class="text-danger">Минимальный заказ должен быть не менее '+min_amount+'!</p>');
        setTimeout(function() {
            form.find('#error').html('');
        }, 2500);
        state = 'fail';
    } else if (val < 0) { /*проверка*/
        form.find('#error').html('<p class="text-danger">Количество не может быть отрицательным!</p>');
        setTimeout(function() {
            form.find('#error').html('');
        }, 2500);
        state = 'fail';
    } else {
        if (val >= min_amount){
            /*переопределяем доступн. к-во*/
            var new_amount = amount-val;
            jQuery(form).find('#amount-hint').html(new_amount);
            jQuery(form).find('#amount').attr('max', new_amount);
        }
    }

    if (state == 'fail') { /*не прошли проверку*/
        return false;
    }

    jQuery.ajax({
        type: 'POST',
        url: url,
        data: {'id': id, 'amount': val},
        success: function(data){
            var jsondata = jQuery.parseJSON(data);
            c(jsondata);
            form.trigger('reset');
            jQuery('.small-cart').show();
            jQuery('.middle-cart').hide();
            jQuery('.cart_itm').html(jsondata.itm);
            jQuery('.cart_sum').html(jsondata.sum);
            jQuery('.cart_pos').html(jsondata.pos);
            form.find('#error').html('<p class="text-success">Товар добавлен в корзину!</p>');
            jQuery('.small-cart').addClass('btn-success op1');
            form.find('.btn').addClass('btn-success');
            setTimeout(function() {
                form.find('#error').html('');
                form.find('.btn').removeClass('btn-success');
                jQuery('.small-cart').removeClass('btn-success op1');
            }, 1000);
        }, 
        error: function(){
            alert('error');
        }
    });


}

function AdddToCart(elm, url){
    var id = jQuery(elm).attr('id');
    var form = jQuery(elm).closest('form');
    var state = 0;

    var size = '';
    form.find('.size-row').each(function(){
        var hint = jQuery(this).find('#amount-hint').text();
        var lab = jQuery(this).find('.size-label').text();
        var val = parseInt(jQuery(this).find('.size-inp-showcase').val(), 10);


        if (val > hint){  /*проверка*/
            form.find('#error').html('<p class="text-danger">Нельзя заказать больше товара чем доступно!</p>');
            setTimeout(function() {
                form.find('#error').html('');
            }, 2500);
            state = 'fail';
        } else if (val < 0) { /*проверка*/
            form.find('#error').html('<p class="text-danger">Количество не может быть отрицательным!</p>');
            setTimeout(function() {
                form.find('#error').html('');
            }, 2500);
            state = 'fail';
        } else {
            if (val > 0){
                /*переопределяем доступн. к-во*/
                var new_hint = hint-val;
                jQuery(this).find('#amount-hint').html(new_hint);
                jQuery(this).find('#amount').attr('max', new_hint);
                size += lab+','+val+':'; /*собираем size*/
            }
        }

    })
    if (state == 'fail') { /*не прошли проверку*/
        return false;
    }

    if (size == '') { /*проверка*/
        form.find('#error').html('<p class="text-danger">Укажите количество товара!</p>');
        setTimeout(function() {
            form.find('#error').html('');
        }, 2500);
        return false; /*не прошли проверку*/
    }

    // jQuery.ajax({
    //     type: 'POST',
    //     url: '<?php //echo Yii::app()->createUrl('order/addtocart/'); ?>',
    //     url: url,
    //     data: {'id': id, 'size': size},
    //     success: function(data){
    //         var jsondata = jQuery.parseJSON(data);
    //         c(jsondata);
    //         form.trigger('reset');
    //         jQuery('.small-cart').show();
    //         jQuery('.middle-cart').hide();
    //         jQuery('.cart_itm').html(jsondata.itm);
    //         jQuery('.cart_sum').html(jsondata.sum);
    //         jQuery('.cart_pos').html(jsondata.pos);
    //         form.find('#error').html('<p class="text-success">Товар добавлен в корзину!</p>');
    //         jQuery('.small-cart').addClass('btn-success op1');
    //         form.find('.btn').addClass('btn-success');
    //         setTimeout(function() {
    //             form.find('#error').html('');
    //             form.find('.btn').removeClass('btn-success');
    //             jQuery('.small-cart').removeClass('btn-success op1');
    //         }, 1000);
    //     }, 
    //     error: function(){
    //         alert('error');
    //     }
    // });

}


function ShowCart(){
    jQuery('.middle-cart').slideDown('500');
    jQuery('.small-cart').hide();
}
function HideCart(){
    jQuery('.middle-cart').slideUp('200');
    setTimeout(function() {
        jQuery('.small-cart').fadeIn('700');
    }, 300);
}