
    <form id="reg_form" action="<?php echo Yii::app()->createUrl("customer/registration/"); ?>" method="post">
 
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
            <input class="form-control required" type="text" id="id_mail" name="mail" value="" onchange="checkMailUnique(this, '<?php echo Yii::app()->createUrl("customer/checkmailunique/"); ?>')">
            <div id="mail_error" class="text-danger" style="height: 15px"></div>

        </div>      
        <div class="form-group">
            <label class="control-label" for="id_pass1">Пароль: <span class="text-danger">*</span></label>
            <input class="form-control required" type="password" id="id_pass1" name="pass1" value="">
        </div>      
        <div class="form-group">
            <label class="control-label" for="id_pass2">Пароль(повторить): <span class="text-danger">*</span></label>
            <input class="form-control required" type="password" id="id_pass2" name="pass2" value="">
        </div>                       

        <div class="form-group">
            <label class="control-label" for="locationField">Адрес: <span class="text-danger">*</span></label>
            <div id="locationField">
              <input id="autocomplete" name="address" class="form-control required" placeholder="Начните вводить адрес" onFocus="geolocate()" type="text" value=""></input>
            </div>
            <input type="hidden" class="" name="lt" id="lt"></input>
            <input type="hidden" class="" name="lg" id="lg"></input>

            <br>
            <div id="addressTypesSet">
                <p>Страна: <span id="country" class="text-muted">Нет данных</span></p>
                <p>Город: <span id="locality" class="text-muted">Нет данных</span></p>
                <p>Область: <span id="administrative_area_level_1" class="text-muted">Нет данных</span></p>
                <p>Улица: <span id="route" class="text-muted">Нет данных</span></p>
                <p>Дом: <span id="street_number" class="text-muted">Нет данных</span></p>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Сохранить</button>
                
        <div id="error" class="text-danger" style="height: 150px"><?php echo $message; ?></div>

    </form>


<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/droog/js/registration.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQW5hZlgbijASBbTn2DoYQmuEWx0uOYG4&signed_in=true&libraries=places&types=geocode&callback=initAutocomplete" async defer></script>