<script src="ckeditor/ckeditor.js"></script>
<form action="" method="post">
	<textarea name="ckeditor"></textarea>
	<button type="submit" name="submit">submit</button>
</form>
<?php 
	if ($_POST) {
		echo $_POST['ckeditor'];
	} else {
		echo '<p>post is empty</p>';
	}
?>
<script>
	CKEDITOR.replace('ckeditor',{
		'filebrowserBrowseUrl':'kcfinder/browse.php?type=files',
		'filebrowserImageBrowseUrl':'kcfinder/browse.php?type=images',
		'filebrowserFlashBrowseUrl':'kcfinder/browse.php?type=flash',
		'filebrowserUploadUrl':'kcfinder/upload.php?type=files',
		'filebrowserImageUploadUrl':'kcfinder/upload.php?type=images',
		'filebrowserFlashUploadUrl':'kcfinder/upload.php?type=flash'
	});
</script>

