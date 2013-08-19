<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:15 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: photo-album.html.php 867 2009-08-17 13:58:08Z Raymond_Benc $
 */
 
 

 if (! empty ( $this->_aVars['aAlbum']['image_path'] )): ?>
<div class="t_center" style="margin-bottom:15px;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('thickbox' => true,'server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'music.url_image','file' => $this->_aVars['aAlbum']['image_path'],'suffix' => '_200','max_width' => '200','max_height' => '200')); ?>
</div>
<?php endif; ?>
