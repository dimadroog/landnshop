<?php echo $item->content; ?>
<div class="text-center">
    Copyright &copy; 2015 - <?php echo date('Y'); ?> by <a target="_blank" href="http://vk.com/id44320505">Dmitry Gorbachev</a>.<br>
    All Rights Reserved.<br/>
    <?php echo Yii::powered(); ?>
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