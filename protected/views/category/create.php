<h1>Создать новую категорию</h1>

<form action="" onsubmit="return CheckRequired()" method="post" enctype="multipart/form-data">
    <div class="ajax-hidden">

        <div class="form-group">
	        <div class="row">
		        <div class="col-md-6">
		            <label class="control-label" for="name">Название <span class="text-danger">*</span></label>
		            <input type="text" id="name" class="form-control required" name="name" value="">
		            <!-- <p class="help-block">Используется для меню сайта и админки</p> -->
		        </div>
	        </div>
        </div>
        

        <div class="form-group">
	        <div class="row">
	            <div class="col-md-6">
                    <label class="control-label" for="parent_category">Родительская категория <span class="text-danger">*</span></label>
                    <select id="parent_category" class="form-control" name="parent_category">
                		<?php foreach (Category::tree(true) as $value): ?>
                        	<option value="<?php echo $value['id']; ?>"><?php echo $value['full_name']; ?></option>
                		<?php endforeach ?>
                    </select>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>