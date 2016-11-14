<?php 
$params = array(
    'condition'=>'publish=1',
    'order'=>'date DESC',
    // 'limit' => 5,
	);
$articles = Article::model()->findAll($params); 
?>

<?php echo $item->content; ?>
<?php foreach ($articles as $key => $item): ?>
    <!-- <div class="panel panel-default <?php // echo ($key%2) ? 'wow slideInRight' : 'wow slideInLeft'; ?>" data-wow-delay=".1s"> -->
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="article-content">
                <h3><?php echo $item->title; ?></h3>
                <p><?php echo $item->content; ?></p>
            </div>
        </div>
    </div>
<?php endforeach ?>    

<?php if (!$articles): ?>
    <h3 class="text-muted">Пока нет статей</h3>
<?php endif; ?>