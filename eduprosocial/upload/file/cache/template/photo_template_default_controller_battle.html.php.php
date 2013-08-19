<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 29, 2013, 3:03 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: battle.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

 if (! isset ( $this->_aVars['aPhotos']['two'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.no_photos_found'); ?>
</div>
<?php else: ?>
<div <?php if ($this->_aVars['bFullMode']): ?> id="photo_battle_full_mode"<?php endif; ?>>
	
	<div id="photo_battl_full_close">
<?php if ($this->_aVars['bFullMode']): ?>
		<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo.battle'); ?>"><?php echo Phpfox::getPhrase('photo.close_full_mode'); ?></a>
<?php else: ?>
		<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo.battle', array('mode' => 'full')); ?>"><?php echo Phpfox::getPhrase('photo.open_full_mode'); ?></a>
<?php endif; ?>
	</div>	
	<div class="photo_battle_holder">
		<div class="photo_battle_left">
			<a href="<?php echo $this->_aVars['aPhotos']['one']['link']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aPhotos']['one']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aPhotos']['one']['destination'],'suffix' => '_'.$this->_aVars['sImageHeight'].'','max_width' => $this->_aVars['sMaxImageHeight'],'max_height' => $this->_aVars['sMaxImageHeight'])); ?></a>
			<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.added_by_full_name_br_on_time_stamp', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPhotos']['one']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPhotos']['one']['user_name'], ((empty($this->_aVars['aPhotos']['one']['user_name']) && isset($this->_aVars['aPhotos']['one']['profile_page_id'])) ? $this->_aVars['aPhotos']['one']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPhotos']['one']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>','time_stamp' => Phpfox::getLib('date')->convertTime($this->_aVars['aPhotos']['one']['time_stamp']))); ?>
			</div>			
		</div>
		<div class="photo_battle_center"><?php echo Phpfox::getPhrase('photo.vs'); ?></div>	
		<div class="photo_battle_right">
			<a href="<?php echo $this->_aVars['aPhotos']['two']['link']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aPhotos']['two']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aPhotos']['two']['destination'],'suffix' => '_'.$this->_aVars['sImageHeight'].'','max_width' => $this->_aVars['sMaxImageHeight'],'max_height' => $this->_aVars['sMaxImageHeight'])); ?></a>
			<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.added_by_full_name_br_on_time_stamp', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPhotos']['two']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPhotos']['two']['user_name'], ((empty($this->_aVars['aPhotos']['two']['user_name']) && isset($this->_aVars['aPhotos']['two']['profile_page_id'])) ? $this->_aVars['aPhotos']['two']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPhotos']['two']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>','time_stamp' => Phpfox::getLib('date')->convertTime($this->_aVars['aPhotos']['two']['time_stamp']))); ?>
			</div>		
		</div>
	</div>
</div>
<?php endif; ?>
