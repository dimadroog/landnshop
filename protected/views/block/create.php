<h2>Cоздать новый блок</h2>
<form action="" onsubmit="return CheckRequired()" method="post" enctype="multipart/form-data">
    <div class="ajax-hidden">

        <div class="form-group">
            <label class="control-label" for="name">Название <span class="text-danger">*</span></label>
            <input type="text" id="name" class="form-control required" name="name">
            <p class="help-block">Используется для меню сайта и админки</p>
        </div>
        
        <div class="form-group <?php echo (Yii::app()->user->name == 'superadmin')?'':'dn'; ?>" id="alias">
            <label class="control-label" for="alias">Alias <span class="text-danger">*</span></label>
            <input type="text" id="alias" class="form-control required" name="alias" value="plain">
        </div>

        <div class="form-group">
            <label class="control-label" for="wysiwyg">Содержимое блока</label>
            <textarea class="form-control" name="wysiwyg" id="wysiwyg" rows="7"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div id="animate" class="form-group">
                    <!-- <label class="control-label" for="animate">Анимация блока при появлении</label> -->
                    <label class="control-label" for="animate"><span id="animationSandbox" style="display: block;">Анимация блока при появлении
                </span></label>
                    <select id="animate_slct" class="form-control" name="animate" onchange="testAnim()">             
                        <optgroup label="Дрожащие">
                          <option value="wow bounce">bounce</option>
                          <option value="wow flash">flash</option>
                          <option value="wow pulse">pulse</option>
                          <option value="wow rubberBand">rubberBand</option>
                          <option value="wow shake">shake</option>
                          <option value="wow swing">swing</option>
                          <option value="wow tada">tada</option>
                          <option value="wow wobble">wobble</option>
                        </optgroup>
                        <optgroup label="Прыгающие">
                          <option value="wow bounceIn">bounceIn</option>
                          <option value="wow bounceInDown">bounceInDown</option>
                          <option value="wow bounceInLeft">bounceInLeft</option>
                          <option value="wow bounceInRight">bounceInRight</option>
                          <option value="wow bounceInUp">bounceInUp</option>
                        </optgroup>
                        <optgroup label="Проявляющиеся">
                          <option value="wow fadeIn">fadeIn</option>
                          <option value="wow fadeInDown">fadeInDown</option>
                          <option value="wow fadeInDownBig">fadeInDownBig</option>
                          <option value="wow fadeInLeft">fadeInLeft</option>
                          <option value="wow fadeInLeftBig">fadeInLeftBig</option>
                          <option value="wow fadeInRight">fadeInRight</option>
                          <option value="wow fadeInRightBig">fadeInRightBig</option>
                          <option value="wow fadeInUp">fadeInUp</option>
                          <option value="wow fadeInUpBig">fadeInUpBig</option>
                        </optgroup>
                        <optgroup label="Вращающиеся">
                          <option value="wow flip">flip</option>
                          <option value="wow flipInX">flipInX</option>
                          <option value="wow flipInY">flipInY</option>
                          <option value="wow rotateIn">rotateIn</option>
                          <option value="wow rotateInDownLeft">rotateInDownLeft</option>
                          <option value="wow rotateInDownRight">rotateInDownRight</option>
                          <option value="wow rotateInUpLeft">rotateInUpLeft</option>
                          <option value="wow rotateInUpRight">rotateInUpRight</option>
                          <option value="wow rollIn">rollIn</option>
                        </optgroup>
                        <optgroup label="Выезжающий">
                          <option value="wow lightSpeedIn">lightSpeedIn</option>
                          <option value="wow slideInUp">slideInUp</option>
                          <option value="wow slideInDown">slideInDown</option>
                          <option value="wow slideInLeft">slideInLeft</option>
                          <option value="wow slideInRight">slideInRight</option>
                        </optgroup>
                        <optgroup label="Приближающиеся">
                          <option value="wow zoomIn">zoomIn</option>
                          <option value="wow zoomInDown">zoomInDown</option>
                          <option value="wow zoomInLeft">zoomInLeft</option>
                          <option value="wow zoomInRight">zoomInRight</option>
                          <option value="wow zoomInUp">zoomInUp</option>
                        </optgroup>
                        <option selected value="">Без анимации</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="colorpicker">Цвет фона блока</label>
                    <div id="colorpicker" class="input-group colorpicker-component">
                        <input type="text" name="bg_color" value="" class="form-control" placeholder="Выбрать цвет" />
                        <span class="input-group-addon"><i><span class="glyphicon glyphicon-tint" aria-hidden="true"></span></i></span>
                    </div>
                    <p class="help-block">Будет работать если нет фонового изображения</p>
                </div>
            </div>
        </div>

        <!-- crop -->
        <div class="form-group">
            <div>
                <label class="control-label" for="image_file">Фоновое изображение блока</label>
                <input type="hidden" id="x1" name="x1">
                <input type="hidden" id="y1" name="y1">
                <input type="hidden" id="x2" name="x2">
                <input type="hidden" id="y2" name="y2">
                <input type="hidden" id="w" name="w">
                <input type="hidden" id="h" name="h">
                <input type="hidden" id="koeff" name="koeff">
                <input type="hidden" id="image_clear" name="image_clear" value="allow">
                <input type="file" style="display:none" name="image_file" id="image_file" onchange="fileSelectHandler()"/>
            </div>
            <a class="btn btn-default" onclick="jQuery('#image_file').click()">Загрузить изображение</a>
            <!-- <p class="text-muted">Изображение должно быть не менее 1900px в ширину</p> -->
        </div> 

        <div class="error text-danger"></div>

        <div id="crop_preview_div">
            <img id="crop_preview" />
            <a id="crop_preview_link" class="dn" onclick="RemoveValueFile()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
        </div>
        <!-- end crop -->

        <div class="row">
            <div class="col-md-6">
                <div id="bg_style_field" class="form-group dn">
                    <label class="control-label" for="bg_style">Позиционирование фонового изображения</label>
                    <select class="form-control" name="bg_style">
                      <option value="background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: top center;">Заполнить</option>
                      <option value="background-repeat: no-repeat; background-position: top center;">Как есть сверху</option>
                      <option value="background-repeat: no-repeat; background-position: bottom center;">Как есть снизу</option>
                      <option value="background-repeat: no-repeat; background-size: 100%;">Ширина 100%</option>
                      <option value="">Замостить</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="content">Публикация</label>
            <div class="checkbox">
                <label>
                  <p><input type="checkbox" name="publish" checked > Отображать этот блок на сайте?</p>
                  <p><input type="checkbox" name="publish_menu" checked > Отображать ссылку в меню на этот блок?</p>
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label" for="weight">Порядок отображения <span class="text-danger">*</span></label>
                    <input type="number" id="weight" class="form-control required" min="1" max="<?php echo Block::weightMax(); ?>" name="weight" value="<?php echo Block::weightValue(); ?>">
                    <p class="help-block">Определите расположение блока по отношению к другим блокам. Чем меньше число - тем выше блок.</p>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>
