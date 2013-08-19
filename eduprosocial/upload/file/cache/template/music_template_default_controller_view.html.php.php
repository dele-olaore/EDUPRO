<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 16, 2013, 2:34 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: view.html.php 3990 2012-03-09 15:28:08Z Raymond_Benc $
 */
 
 

?>
<div class="music_rate_body">
	<div class="music_rate_display">
<?php Phpfox::getBlock('rate.display', array()); ?>
	</div>
</div>
<div class="item_view">
    <div class="item_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aSong']['time_stamp']); ?> <?php echo Phpfox::getPhrase('music.by_lowercase'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aSong']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aSong']['user_name'], ((empty($this->_aVars['aSong']['user_name']) && isset($this->_aVars['aSong']['profile_page_id'])) ? $this->_aVars['aSong']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aSong']['full_name'], 50, '...') . '</a></span>';  if ($this->_aVars['aSong']['album_id']): ?> <?php echo Phpfox::getPhrase('music.in'); ?> <a href="<?php echo Phpfox::permalink('music.album', $this->_aVars['aSong']['album_id'], $this->_aVars['aSong']['album_url'], false, null, (array) array (
)); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['album_url']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['album_url']), 50, '...'), 50); ?></a><?php endif; ?>
    </div>
    
<?php if ($this->_aVars['aSong']['view_id'] != 0): ?>
	<div class="message js_moderation_off" id="js_approve_message">
<?php echo Phpfox::getPhrase('music.song_is_pending_approval'); ?>
	</div>
<?php endif; ?>

<?php if (Phpfox ::getUserParam('music.can_approve_songs') || ( ( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_song')) || Phpfox ::getUserParam('music.can_edit_other_song')) || ( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_delete_own_track')) || Phpfox ::getUserParam('music.can_delete_other_tracks') || ( Phpfox ::getUserParam('music.can_purchase_sponsor_song') && $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId())): ?>
	<div class="item_bar">
		<div class="item_bar_action_holder">
<?php if ($this->_aVars['aSong']['view_id'] != 0 && Phpfox ::getUserParam('music.can_approve_songs')): ?>
				<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>			
				<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('music.approveSong', 'inline=true&amp;id=<?php echo $this->_aVars['aSong']['song_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('music.approve'); ?></a>
<?php endif; ?>
			<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('music.actions'); ?></span></a>		
			<ul>
				<?php /* Cached: June 16, 2013, 2:34 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: menu.html.php 3737 2011-12-09 07:50:12Z Raymond_Benc $
 */
 
 

?>
<?php if (( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_song')) || Phpfox ::getUserParam('music.can_edit_other_song')): ?>
	<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.upload', array('id' => $this->_aVars['aSong']['song_id'])); ?>"><?php echo Phpfox::getPhrase('music.edit'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['aSong']['view_id'] == 0 && Phpfox ::getUserParam('music.can_feature_songs')): ?>
	<li><a id="js_feature_<?php echo $this->_aVars['aSong']['song_id']; ?>"<?php if ($this->_aVars['aSong']['is_featured']): ?> style="display:none;"<?php endif; ?> href="#" title="<?php echo Phpfox::getPhrase('music.feature_this_song'); ?>" onclick="$('#js_featured_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>').hide(); $(this).hide(); $('#js_unfeature_<?php echo $this->_aVars['aSong']['song_id']; ?>').show(); $(this).parents('.js_song_parent:first').addClass('row_featured').find('.js_featured_song').show(); $.ajaxCall('music.featureSong', 'song_id=<?php echo $this->_aVars['aSong']['song_id']; ?>&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('music.feature'); ?></a></li>
	<li><a id="js_unfeature_<?php echo $this->_aVars['aSong']['song_id']; ?>"<?php if (! $this->_aVars['aSong']['is_featured']): ?> style="display:none;"<?php endif; ?> href="#" title="<?php echo Phpfox::getPhrase('music.un_feature_this_song'); ?>" onclick="$('#js_featured_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>').show(); $(this).hide(); $('#js_feature_<?php echo $this->_aVars['aSong']['song_id']; ?>').show(); $(this).parents('.js_song_parent:first').removeClass('row_featured').find('.js_featured_song').hide(); $.ajaxCall('music.featureSong', 'song_id=<?php echo $this->_aVars['aSong']['song_id']; ?>&amp;type=0'); return false;"><?php echo Phpfox::getPhrase('music.unfeature'); ?></a></li>
<?php endif; ?>
	
<?php if (Phpfox ::getUserParam('music.can_sponsor_song')): ?>
	    <li>
		<span id="js_sponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>" class="" style="<?php if ($this->_aVars['aSong']['is_sponsor'] != 1): ?>display:none;<?php endif; ?>">
		    <a href="#" onclick="$('#js_sponsor_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>').hide(); $('#js_sponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>').hide();$('#js_unsponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>').show();$.ajaxCall('music.sponsorSong','song_id=<?php echo $this->_aVars['aSong']['song_id']; ?>&type=0', 'GET'); return false;">
<?php echo Phpfox::getPhrase('music.unsponsor_this_song'); ?>
		    </a>
		</span>
		<span id="js_unsponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>" class="" style="<?php if ($this->_aVars['aSong']['is_sponsor'] == 1): ?>display:none;<?php endif; ?>">
		    <a href="#" onclick="$('#js_sponsor_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>').show(); $('#js_sponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>').show();$('#js_unsponsor_<?php echo $this->_aVars['aSong']['song_id']; ?>').hide();$.ajaxCall('music.sponsorSong','song_id=<?php echo $this->_aVars['aSong']['song_id']; ?>&type=1', 'GET'); return false;">
<?php echo Phpfox::getPhrase('music.sponsor_this_song'); ?>
		    </a>
		</span>
	    </li>
<?php elseif (Phpfox ::getUserParam('music.can_purchase_sponsor_song') && $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && $this->_aVars['aSong']['is_sponsor'] != 1): ?>
	    <li>
		<a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aSong']['song_id'], null, false, null, (array) array (
)); ?>section_music-song/">
<?php echo Phpfox::getPhrase('music.sponsor_this_song'); ?>
		</a>
	    </li>
<?php endif; ?>
<?php if (( ( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_delete_own_track')) || Phpfox ::getUserParam('music.can_delete_other_tracks')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
	<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.delete', array('id' => $this->_aVars['aSong']['song_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('music.are_you_sure'); ?>');"><?php echo Phpfox::getPhrase('music.delete'); ?></a></li>
<?php endif; ?>
	
			</ul>			
		</div>		
	</div>       
<?php endif; ?>

	<div id="js_music_player" style="height:30px; width:500px;"></div>
	
	<div class="music_view_total_play">
<?php echo Phpfox::getPhrase('music.total_plays', array('total' => number_format($this->_aVars['aSong']['total_play']))); ?>
	</div>	
	<div <?php if ($this->_aVars['aSong']['view_id'] != 0): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
<?php Phpfox::getBlock('feed.comment', array()); ?>
	</div>
</div>
