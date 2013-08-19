<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:45 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 2569 2011-04-27 19:03:20Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aSongs'] )):  if (count((array)$this->_aVars['aSongs'])):  $this->_aPhpfoxVars['iteration']['songs'] = 0;  foreach ((array) $this->_aVars['aSongs'] as $this->_aVars['aSong']):  $this->_aPhpfoxVars['iteration']['songs']++; ?>

	<?php /* Cached: May 28, 2013, 11:45 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: entry.html.php 3990 2012-03-09 15:28:08Z Raymond_Benc $
 */
 
 

?>
<div id="js_controller_music_track_<?php echo $this->_aVars['aSong']['song_id']; ?>" class="js_music_track js_song_parent <?php if (isset ( $this->_aVars['aSong']['is_sponsor'] ) && $this->_aVars['aSong']['is_sponsor']): ?>row_sponsored <?php endif;  if ($this->_aVars['aSong']['is_featured']): ?>row_featured <?php endif; ?> <?php if (isset ( $this->_aPhpfoxVars['iteration']['songs'] ) && is_int ( $this->_aPhpfoxVars['iteration']['songs'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if (isset ( $this->_aPhpfoxVars['iteration']['songs'] ) && $this->_aPhpfoxVars['iteration']['songs'] == 1): ?> row_first<?php endif;  if ($this->_aVars['aSong']['view_id'] == '1' && ! isset ( $this->_aVars['bIsInPendingMode'] )): ?> row_moderate<?php endif; ?>">

<?php if ($this->_aVars['aSong']['view_id'] == '1' && ! isset ( $this->_aVars['bIsInPendingMode'] )): ?>
	<div class="row_moderate_info">
<?php echo Phpfox::getPhrase('music.pending_approval'); ?>
	</div>
<?php endif; ?>

	<div class="row_title">	

		<div class="row_title_image">
			
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'): ?>
<?php else: ?>
			<div id="js_featured_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>" class="js_featured_song row_featured_link"<?php if (! $this->_aVars['aSong']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('music.featured'); ?>
			</div>					
<?php endif; ?>
			<div id="js_sponsor_phrase_<?php echo $this->_aVars['aSong']['song_id']; ?>" class="js_sponsor_event row_sponsored_link"<?php if (! $this->_aVars['aSong']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('music.sponsored'); ?>
			</div>
			
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aSong'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php if (( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_song')) || Phpfox ::getUserParam('music.can_edit_other_song') || ( $this->_aVars['aSong']['view_id'] == 0 && Phpfox ::getUserParam('music.can_feature_songs')) || ( $this->_aVars['aSong']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_delete_own_track')) || Phpfox ::getUserParam('music.can_delete_other_tracks') || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
			<div class="row_edit_bar_parent">
				<div class="row_edit_bar_holder">
					<ul>
						<?php /* Cached: May 28, 2013, 11:45 am */  
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
				<div class="row_edit_bar">				
						<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('music.actions'); ?></span></a>							
				</div>
			</div>				
<?php endif; ?>
<?php if (Phpfox ::getUserParam('music.can_approve_songs') || Phpfox ::getUserParam('music.can_delete_other_tracks') || Phpfox ::getUserParam('music.can_feature_songs')): ?><a href="#<?php echo $this->_aVars['aSong']['song_id']; ?>" class="moderate_link" rel="musicsong"><?php echo Phpfox::getPhrase('music.moderate'); ?></a><?php endif; ?>
		</div>
		<div class="row_title_info">    
	
			<div id="js_controller_music_play_<?php echo $this->_aVars['aSong']['song_id']; ?>">
				<div class="go_left">
					<a href="#" onclick="$.ajaxCall('music.playInFeed', 'id=<?php echo $this->_aVars['aSong']['song_id']; ?>', 'GET'); return false;" title="<?php echo Phpfox::getPhrase('music.play'); ?>: <?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['title']); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/play_button.png','class' => 'v_middle')); ?></a>
				</div>
				<div class="music_title_link">
					<a href="<?php echo Phpfox::permalink('music', $this->_aVars['aSong']['song_id'], $this->_aVars['aSong']['title'], false, null, (array) array (
)); ?>" class="link" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['title']); ?>" <?php if (defined ( 'PHPFOX_IS_POPUP' )): ?> onclick="window.opener.location.href=this.href; return false;"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['title']), 50, '...'), 40); ?></a>
<?php if (! empty ( $this->_aVars['aSong']['album_name'] )): ?>
					<div class="extra_info">
						<a href="<?php echo Phpfox::permalink('music.album', $this->_aVars['aSong']['album_id'], $this->_aVars['aSong']['album_name'], false, null, (array) array (
)); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['album_name']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aSong']['album_name']), 55, '...'), 40); ?></a>
					</div>
<?php endif; ?>
				</div>			
				<div class="clear"></div>
			</div>
			
<?php if (isset ( $this->_aVars['aUser'] ) && $this->_aVars['aUser']['user_id'] != $this->_aVars['aSong']['user_id'] || ! defined ( 'PHPFOX_IS_USER_PROFILE' )): ?>
			<div class="extra_info">
				<ul class="extra_info_middot"><li><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aSong']['time_stamp']); ?> <?php echo Phpfox::getPhrase('music.by_lowercase'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aSong']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aSong']['user_name'], ((empty($this->_aVars['aSong']['user_name']) && isset($this->_aVars['aSong']['profile_page_id'])) ? $this->_aVars['aSong']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aSong']['full_name'], 50, '...') . '</a></span>'; ?></li><?php if ($this->_aVars['aSong']['total_play'] > 1): ?><li><span>&middot;</span></li><li><?php echo Phpfox::getPhrase('music.total_plays', array('total' => $this->_aVars['aSong']['total_play'])); ?></li><?php endif; ?></ul>
			</div>
<?php endif; ?>
			
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aSong']['aFeed'])); ?>
			
		</div>		
	</div>
</div>
<?php endforeach; endif;  if (Phpfox ::getUserParam('music.can_approve_songs') || Phpfox ::getUserParam('music.can_delete_other_tracks') || Phpfox ::getUserParam('music.can_feature_songs')):  Phpfox::getBlock('core.moderation');  endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('music.no_songs_found'); ?>
</div>
<?php endif; ?>
