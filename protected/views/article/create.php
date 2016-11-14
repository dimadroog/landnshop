<h2>Cоздать новую статью</h2>
<form action="" onsubmit="return CheckRequired()" method="post" enctype="multipart/form-data">
    <div class="ajax-hidden">
        <div class="form-group">
            <label class="control-label" for="title">Заголовок <span class="text-danger">*</span></label>
            <input type="text" id="title" class="form-control required" name="title">
        </div>

        <div class="row">
            <div class="col-sm-6">
            
                <div class="form-group">
                    <label class="control-label" for="unit">Еденица измерения <span class="text-danger">*</span></label>
                    <select id="unit" class="form-control required" name="unit">
                        <option value="м.">м.</option>
                        <option value="шт.">шт.</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="price">Цена <span class="text-danger">*</span></label>
                    <input type="number" id="price" class="form-control required" name="price" value="">
                </div>

                <div class="form-group">
                    <label class="control-label" for="amount">Доступное количество <span class="text-danger">*</span></label>
                    <input type="number" id="amount" class="form-control required" name="amount" value="">
                </div>

                <div class="form-group">
                    <label class="control-label" for="min_amount">Минимальное количество для заказа</label>
                    <input type="number" id="min_amount" class="form-control" name="min_amount" value="">
                </div>

            </div>
        </div>

        <div id="category_select2" class="form-group">
            <label class="control-label" for="select2">Категории</label>
            <select id="select2" class="form-control" name="category[]" multiple>
                <?php foreach (Category::tree() as $value): ?>
                      <option value="<?php echo $value['id']; ?>"><?php echo $value['full_name']; ?></option>
                <?php endforeach ?>
            </select>
            <p class="help-block">Выберите одну или несколько категорий.</p>
        </div>
        <div class="row">
            <div class='col-sm-6'>
                <div class="form-group">
                 <label class="control-label" for="date">Дата <span class="text-danger">*</span></label>
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control required" name="date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function() {
              jQuery('#datetimepicker').datetimepicker({
                  locale: 'ru',
                  format: 'DD.MM.YYYY',
                  // defaultDate: new Date(<?php echo date('Y, m, d, H, i', $item->date); ?>),
                  defaultDate: Date.now(),
              });
            });
        </script>

        <div class="form-group">
            <label class="control-label" for="wysiwyg">Содержимое статьи </label>
            <textarea class="form-control" name="wysiwyg" id="wysiwyg" rows="7"></textarea>
        </div>

        <div class="form-group">
            <label class="control-label" for="preview">Превью (анонс) </label>
            <textarea class="form-control" name="preview" id="preview" rows="7"></textarea>            
            <p class="help-block">Ознакомительная часть статьи. Будет видна в общем списке статей на сайте.</p>
        </div>


        <div class="form-group">
            <label class="control-label">Изображения</label>
            <p>
                <a class="btn btn-default upload_container" onclick="jQuery('#files').click()">Загрузить изображения</a>
                <input id="files" style="display:none" name="files[]" type="file" multiple/>
            </p>
            <output id="list"></output>
        </div>


        <div class="form-group">
            <label class="control-label" for="publish">Публикация</label>
            <div class="checkbox">
                <label>
                  <p><input type="checkbox" name="publish" checked > Опубликовать статью</p>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>
