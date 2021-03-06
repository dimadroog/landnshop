    function checkMailUnique(elm, url){
        var field = jQuery(elm);
        var val = jQuery(elm).val();
        jQuery.ajax({
            type: 'POST',
            url: url,
            data: {'mail': field.val() },
            success: function(data){
                if (data == 'fail') {
                    jQuery('#id_mail').parent().removeClass('has-error');   
                    jQuery('#mail_error').append('<br>Пользователь с email '+field.val()+' уже зарегистрирован ранее');
                    field.val('');
                    field.attr('placeholder', val);
                    setTimeout(function() {
                        jQuery('#id_mail').parent().removeClass('has-error');   
                        jQuery('#mail_error').html('');
                    }, 3000); 
                }
            }, 
            error: function(){
                alert('error');
            }
        });
    }

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
                }, 3000); 
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
            }, 3000); 
            state = 'fail';     
        };

        var pass1 = jQuery('#id_pass1');
        var pass2 = jQuery('#id_pass2');
        if(pass1.val() != pass2.val()) {
            pass1.parent().addClass('has-error'); 
            pass2.parent().addClass('has-error'); 
            // pass1.val(''); 
            // pass2.val(''); 
            jQuery('#error').append('<br>Пароли не совпадают');
            setTimeout(function() {
                jQuery(pass1).parent().removeClass('has-error');   
                jQuery(pass2).parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 3000); 
            state = 'fail';     
        };


        var voidaddress = 1;
        jQuery('#addressTypesSet').find('span').each(function(){
            var span = jQuery(this);
            if (span.hasClass('text-danger')) {
                voidaddress = 1;
            } else {
                voidaddress = 0;
            }
        });
        if(voidaddress == 1){
            jQuery('#error').append('<br>Адрес не полон');
            jQuery('#addressTypesSet').parent().addClass('has-error'); 
            setTimeout(function() {
                jQuery('#addressTypesSet').parent().removeClass('has-error');   
                jQuery('#error').html('');
            }, 3000); 
            state = 'fail';  
        }


        if (state == 'fail'){
            jQuery('#error').prepend('<br><b>Ошибки:</b>');
            location.hash = 'error';
            return false;
        }
        // c(state);
      });

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        return pattern.test(emailAddress);
    }







// Google place autocomplete

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
};

function initAutocomplete() {
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  jQuery('#lt').val(place.geometry.location.lat());
  jQuery('#lg').val(place.geometry.location.lng());
  jQuery('#addressTypesSet').find('span').addClass('text-danger');

  for (var component in componentForm) {
    jQuery('#'+component).html('Нет данных');
    // document.getElementById(component).value = '';
    // document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
      jQuery('#'+addressType).html(val);
        if (jQuery('#'+addressType).text() != 'Нет данных') {
            jQuery('#'+addressType).removeClass('text-danger');
            jQuery('#'+addressType).addClass('text-success');
        }
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]