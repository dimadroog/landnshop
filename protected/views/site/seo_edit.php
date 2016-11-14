<h2>Редактировать данные</h2>

<form action="" onsubmit="return CheckRequired()" method="post">
    <div class="ajax-hidden">
        <div class="form-group">
            <label class="control-label" for="seo_title">Title<span class="text-danger">*</span></label>
            <input type="text" id="seo_title" class="form-control required" name="seo_title" value="<?php echo $item->seo_title; ?>">
        </div>

        <div class="form-group" data-wow-delay=".2s">
            <label class="control-label" for="seo_description">Description<span class="text-danger">*</span></label>
            <textarea class="form-control required" id="seo_description" name="seo_description" rows="7"><?php echo $item->seo_description; ?></textarea>
        </div>

        <div class="form-group" data-wow-delay=".2s">
            <label class="control-label" for="seo_keywords">Keywords<span class="text-danger">*</span></label>
            <textarea class="form-control required" id="seo_keywords" name="seo_keywords" rows="7"><?php echo $item->seo_keywords; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>