<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 13, 2013, 11:05 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: image.html.php 2521 2011-04-12 17:20:31Z Raymond_Benc $
 */
 
 

?>
<div class="t_center" style="margin-bottom:10px;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('thickbox' => true,'server_id' => $this->_aVars['aEvent']['server_id'],'title' => $this->_aVars['aEvent']['title'],'path' => 'event.url_image','file' => $this->_aVars['aEvent']['image_path'],'suffix' => '_200','max_width' => '200','max_height' => '200')); ?>
</div>
