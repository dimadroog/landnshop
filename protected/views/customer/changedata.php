
    <form id="cd_form" action="" onsubmit="return CheckRequired()" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Изменить данные</h2>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="id_name">Имя: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="id_name" name="name" value="<?php echo $user->name; ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_phone">Телефон: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="id_phone" name="phone" value="<?php echo $user->phone; ?>">
                </div>    
                <div class="form-group">
                    <label class="control-label" for="id_mail">EMail: <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="id_mail" name="mail" value="<?php echo $user->mail; ?>">
                </div>                       
                <div class="form-group">
                    <label class="control-label" for="locationField">Адрес: <span class="text-danger">*</span></label>
                    <div id="locationField">
                      <input id="autocomplete" name="address" class="form-control required" placeholder="Начните вводить адрес" onFocus="geolocate()" type="text" value="<?php echo Customer::getAddress($user->id); ?>"></input>
                    </div>
                    <input type="hidden" class="" name="lt" value="<?php echo $user->position_lt; ?>" id="lt"></input>
                    <input type="hidden" class="" name="lg" value="<?php echo $user->position_lg; ?>" id="lg"></input>
                    <br>
                    <p class="text-muted">Текщий адрес: <span id="current_address"><?php echo Customer::getAddress($user->id); ?></span></p>
                    <div id="addressTypesSet" class="dn">
                        <p>Страна: <span id="country" class="text-muted">Нет данных</span></p>
                        <p>Город: <span id="locality" class="text-muted">Нет данных</span></p>
                        <p>Область: <span id="administrative_area_level_1" class="text-muted">Нет данных</span></p>
                        <p>Улица: <span id="route" class="text-muted">Нет данных</span></p>
                        <p>Дом: <span id="street_number" class="text-muted">Нет данных</span></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <div id="error" class="text-danger" style="height: 150px"><?php echo $message; ?></div>

            </div>
        </div>
    </form>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/droog/js/changedata.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQW5hZlgbijASBbTn2DoYQmuEWx0uOYG4&signed_in=true&libraries=places&types=geocode&callback=initAutocomplete" async defer></script>