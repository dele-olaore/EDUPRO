<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 29, 2013, 1:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: player.html.php 3553 2011-11-22 16:46:19Z Raymond_Benc $
 */
 
 

?>
<div id="js_music_player_all" style="height:30px; width:100%; display:none;"></div>
<div class="label_flow" style="height:350px;">
<?php Phpfox::getBlock('music.track', array('album_user_id' => $this->_aVars['aAlbum']['user_id'],'album_id' => $this->_aVars['aAlbum']['album_id'],'is_player' => true)); ?>
</div>
