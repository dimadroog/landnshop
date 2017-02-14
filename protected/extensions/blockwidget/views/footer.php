<?php echo $item->content; ?>
<div class="text-center footer">
    <p>
        Copyright by <a href="<?php echo Yii::app()->createUrl('/site/index/'); ?>"><?php echo Setting::getData('sitename'); ?></a> &copy; 2015 - <?php echo date('Y'); ?>. All Rights Reserved.
    </p>
    <p>
        Powered by <a target="_blank" href="http://droog.cf/article/index">landnshop</a>
    </p>
    <div class="hidden-xs hidden-sm">
        <div class="social-icon-container"> 
            <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,gplus,moimir">
            </div>
        </div>
    </div>
</div>


<div id="primary_footer"></div>
<script type="text/javascript">
    jQuery('#primary_footer').closest('.block-content').addClass('bg-primary'); 
</script>