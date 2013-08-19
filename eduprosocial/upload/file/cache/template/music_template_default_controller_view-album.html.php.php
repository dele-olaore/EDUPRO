<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:15 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: view-album.html.php 3990 2012-03-09 15:28:08Z Raymond_Benc $
 */
 
 

?>
<div class="item_view">

    <div class="item_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aAlbum']['time_stamp']); ?> <?php echo Phpfox::getPhrase('music.by_lowercase'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aAlbum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aAlbum']['user_name'], ((empty($this->_aVars['aAlbum']['user_name']) && isset($this->_aVars['aAlbum']['profile_page_id'])) ? $this->_aVars['aAlbum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aAlbum']['full_name'], 50, '...') . '</a></span>'; ?>
    </div>
    
<?php if ($this->_aVars['aAlbum']['view_id'] != 0): ?>
	<div class="message js_moderation_off" id="js_approve_message">
<?php echo Phpfox::getPhrase('music.album_is_pending_approval'); ?>
	</div>
<?php endif; ?>

<?php if (( ( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_albums')) || Phpfox ::getUserParam('music.can_edit_other_music_albums'))) || ( ( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_albums')))) || ( $this->_aVars['aAlbum']['view_id'] == 0 && Phpfox ::getUserParam('music.can_feature_music_albums')) || ( Phpfox ::getUserParam('music.can_sponsor_album')) || ( Phpfox ::getUserParam('music.can_purchase_sponsor_album') && ! $this->_aVars['aAlbum']['is_sponsor'] && ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId())) || ( ( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_delete_own_music_album')) || Phpfox ::getUserParam('music.can_delete_other_music_albums')))): ?>
	<div class="item_bar">
		<div class="item_bar_action_holder">	
			<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('music.actions'); ?></span></a>		
			<ul>
				<?php /* Cached: May 28, 2013, 1:15 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: menu-album.html.php 3346 2011-10-24 15:20:05Z Raymond_Benc $
 */
 
 

?>
<?php if (( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_albums')) || Phpfox ::getUserParam('music.can_edit_other_music_albums'))): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.album', array('id' => $this->_aVars['aAlbum']['album_id'])); ?>"><?php echo Phpfox::getPhrase('music.edit'); ?></a></li>
<?php endif; ?>
<?php if (( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_albums')))): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.album.track', array('id' => $this->_aVars['aAlbum']['album_id'])); ?>"><?php echo Phpfox::getPhrase('music.upload_new_track'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['aAlbum']['view_id'] == 0 && Phpfox ::getUserParam('music.can_feature_music_albums')): ?>
		<li><a id="js_feature_<?php echo $this->_aVars['aAlbum']['album_id']; ?>"<?php if ($this->_aVars['aAlbum']['is_featured']): ?> style="display:none;"<?php endif; ?> href="#" title="<?php echo Phpfox::getPhrase('music.feature_this_album'); ?>" onclick="$(this).hide(); $('#js_unfeature_<?php echo $this->_aVars['aAlbum']['album_id']; ?>').show(); $(this).parents('.js_album_parent:first').addClass('row_featured').find('.js_featured_album').show(); $.ajaxCall('music.featureAlbum', 'album_id=<?php echo $this->_aVars['aAlbum']['album_id']; ?>&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('music.feature'); ?></a></li>
		<li><a id="js_unfeature_<?php echo $this->_aVars['aAlbum']['album_id']; ?>"<?php if (! $this->_aVars['aAlbum']['is_featured']): ?> style="display:none;"<?php endif; ?> href="#" title="<?php echo Phpfox::getPhrase('music.un_feature_this_album'); ?>" onclick="$(this).hide(); $('#js_feature_<?php echo $this->_aVars['aAlbum']['album_id']; ?>').show(); $(this).parents('.js_album_parent:first').removeClass('row_featured').find('.js_featured_album').hide(); $.ajaxCall('music.featureAlbum', 'album_id=<?php echo $this->_aVars['aAlbum']['album_id']; ?>&amp;type=0'); return false;"><?php echo Phpfox::getPhrase('music.unfeature'); ?></a></li>
<?php endif; ?>

<?php if (Phpfox ::getUserParam('music.can_sponsor_album')): ?>
		<li>
			<a href='#' onclick="$.ajaxCall('music.sponsorAlbum','album_id=<?php echo $this->_aVars['aAlbum']['album_id']; ?>&type=<?php if ($this->_aVars['aAlbum']['is_sponsor'] == 1): ?>0<?php else: ?>1<?php endif; ?>');return false;">
<?php if ($this->_aVars['aAlbum']['is_sponsor'] == 1): ?>
<?php echo Phpfox::getPhrase('music.unsponsor_this_album'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('music.sponsor_this_album'); ?>
<?php endif; ?>
			</a>
		</li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('music.can_purchase_sponsor_album') && ! $this->_aVars['aAlbum']['is_sponsor'] && ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId())): ?>
		<li>
			<a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aAlbum']['album_id'], null, false, null, (array) array (
)); ?>section_music-album/">
<?php echo Phpfox::getPhrase('music.encourage_sponsor_album'); ?>
			</a>
		</li>
<?php endif; ?>
	
<?php if (( ( $this->_aVars['aAlbum']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_delete_own_music_album')) || Phpfox ::getUserParam('music.can_delete_other_music_albums'))): ?>
		<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.browse.album', array('id' => $this->_aVars['aAlbum']['album_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('music.are_you_sure_this_will_delete_all_tracks_that_belong_to_this_album_and_cannot_be_undone', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('music.delete'); ?></a></li>
<?php endif; ?>
			</ul>			
		</div>		
	</div>    
<?php endif; ?>
    
<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aAlbum']['text']); ?>
	
	<div <?php if ($this->_aVars['aAlbum']['view_id'] != 0): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
<?php Phpfox::getBlock('feed.comment', array()); ?>
	</div>
</div>
