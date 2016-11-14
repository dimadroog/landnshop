<?php if ($item->content): ?>
<?php 
	$dom=new DOMDocument();
	$dom->loadHTML($item->content);
	$xml=simplexml_import_dom($dom); // just to make xpath more simple
	$images=$xml->xpath('//img');
	// foreach ($images as $img) {
	//     echo $img['src'].'<br>';
	// }
?>

<!--     <div class="container">
	   <?php //echo preg_replace('/<img[^>]+\>/i', '', $item->content); ?>
    </div> -->

	<div id="myCarouselFull<?php echo $item->id; ?>" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php foreach ($images as $key => $value): ?>
				<li data-target="#myCarouselFull<?php echo $item->id; ?>" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0)?'active':''; ?>"></li>
			<?php endforeach; ?>
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php foreach ($images as $key => $value): ?>
					<div class="item <?php echo ($key == 0)?'active':''; ?>">
						<img src="<?php echo $value['src']; ?>" style="width: 100%">
					</div>
			<?php endforeach; ?>
		</div>

		<a class="left carousel-control" href="#myCarouselFull<?php echo $item->id; ?>" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true">&nbsp</span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarouselFull<?php echo $item->id; ?>" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true">&nbsp</span>
			<span class="sr-only">Next</span>
		</a>
	</div>
<?php endif; ?>


<div id="full_carousel"></div>
<script type="text/javascript">
    jQuery('#full_carousel').parent().removeClass('container'); 
    jQuery('#full_carousel').parent().parent().css({'padding-bottom': '0','padding-top': '0',}); 
</script>