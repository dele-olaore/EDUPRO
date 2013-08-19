<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:45 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: inner.html.php 2726 2011-07-14 11:17:13Z Miguel_Espinoza $
 */
 
 

?>


<?php if ($this->_aVars['aAd']['type_id'] == 1): ?>
	<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('ad', array('id' => $this->_aVars['aAd']['ad_id'])); ?>" target="_blank"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('file' => $this->_aVars['aAd']['image_path'],'path' => 'ad.url_image','server_id' => $this->_aVars['aAd']['server_id'])); ?></a>
<?php else: ?>
<?php echo $this->_aVars['aAd']['html_code'];  endif; ?>
        

<?php if (Phpfox ::getParam('ad.ad_ajax_refresh')): ?>

<script type="text/javascript">	
<?php if ($this->_aVars['aAd']['type_id'] == 2):  echo '
window.parent.$(function()
{
	'; ?>
			
	if (window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>_frame').length > 0)
	{
	setTimeout("window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>_frame').attr('src', '<?php echo Phpfox::getLib('phpfox.url')->makeUrl('ad.iframe', array('id' => $this->_aVars['aAd']['location'])); ?>');", (<?php echo Phpfox::getParam('ad.ad_ajax_refresh_time'); ?> * 60000));
	}
	else
	{
	setTimeout("window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>').html('<iframe allowtransparency=\"true\" id=\"js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>_frame\" frameborder=\"0\" style=\"width:' + window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>').width() + 'px; height:' + window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>').height() + 'px;\"></iframe>'); window.parent.$('#js_ad_space_<?php echo $this->_aVars['aAd']['location']; ?>_frame').attr('src', '<?php echo Phpfox::getLib('phpfox.url')->makeUrl('ad.iframe', array('id' => $this->_aVars['aAd']['location'])); ?>');", (<?php echo Phpfox::getParam('ad.ad_ajax_refresh_time'); ?> * 60000));
	}		
	<?php echo '
});
'; ?>

<?php else: ?>
	setTimeout('$.ajaxCall(\'ad.update\', \'block_id=<?php echo $this->_aVars['aAd']['location']; ?>\');', (<?php echo Phpfox::getParam('ad.ad_ajax_refresh_time'); ?> * 60000));
<?php endif; ?>
</script>
<?php endif;  (($sPlugin = Phpfox_Plugin::get('ad.template_block_display__end')) ? eval($sPlugin) : false); ?>
