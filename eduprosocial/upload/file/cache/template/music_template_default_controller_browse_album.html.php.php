<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:51 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: album.html.php 3990 2012-03-09 15:28:08Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aAlbums'] )):  if (count((array)$this->_aVars['aAlbums'])):  $this->_aPhpfoxVars['iteration']['albums'] = 0;  foreach ((array) $this->_aVars['aAlbums'] as $this->_aVars['aAlbum']):  $this->_aPhpfoxVars['iteration']['albums']++; ?>

<div id="js_album_<?php echo $this->_aVars['aAlbum']['album_id']; ?>" class="js_album_parent <?php if ($this->_aVars['aAlbum']['is_sponsor']): ?>row_sponsored <?php endif;  if ($this->_aVars['aAlbum']['is_featured']): ?>row_featured <?php endif;  if (is_int ( $this->_aPhpfoxVars['iteration']['albums'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['albums'] == 1): ?> row_first<?php endif; ?>">
	<div class="row_title">		

		<div class="row_title_image">			
			
			<a href="<?php echo Phpfox::permalink('music.album', $this->_aVars['aAlbum']['album_id'], $this->_aVars['aAlbum']['name'], false, null, (array) array (
)); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'music.url_image','file' => $this->_aVars['aAlbum']['image_path'],'suffix' => '_50_square','max_width' => '50','max_height' => '50')); ?></a>
			
			<div class="row_edit_bar_parent">
				<div class="row_edit_bar_holder">
					<ul>
						<?php /* Cached: May 28, 2013, 11:51 am */  
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
				<div class="row_edit_bar">				
					<a href="#" class="row_edit_bar_action"><span>Actions</span></a>							
				</div>
			</div>				
			
<?php if (Phpfox ::getUserParam('blog.can_approve_blogs') || Phpfox ::getUserParam('blog.delete_user_blog')): ?><a href="#<?php echo $this->_aVars['aAlbum']['album_id']; ?>" class="moderate_link" rel="blog">Moderate</a><?php endif; ?>
		</div>
		<div class="row_title_info">    
	
			<a href="<?php echo Phpfox::permalink('music.album', $this->_aVars['aAlbum']['album_id'], $this->_aVars['aAlbum']['name'], false, null, (array) array (
)); ?>" class="link" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']); ?>" <?php if (defined ( 'PHPFOX_IS_POPUP' )): ?> onclick="window.opener.location.href=this.href; return false;"<?php endif; ?>><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']), 50, '...'), 30); ?></a>
			
			<div class="extra_info">
				<ul class="extra_info_middot"><li><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aAlbum']['time_stamp']); ?> <?php echo Phpfox::getPhrase('music.by_lowercase'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aAlbum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aAlbum']['user_name'], ((empty($this->_aVars['aAlbum']['user_name']) && isset($this->_aVars['aAlbum']['profile_page_id'])) ? $this->_aVars['aAlbum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aAlbum']['full_name'], 30, '...') . '</a></span>'; ?></li><li><span>&middot;</span></li><li><?php echo Phpfox::getPhrase('music.total_tracks', array('total' => number_format($this->_aVars['aAlbum']['total_track']))); ?></li><li><span>&middot;</span></li><li><?php echo Phpfox::getPhrase('music.total_plays', array('total' => number_format($this->_aVars['aAlbum']['total_play']))); ?></li></ul>
			</div>
			
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aAlbum']['aFeed'])); ?>
			
		</div>		
	</div>
</div>
<?php endforeach; endif;  if (Phpfox ::getUserParam('music.can_delete_other_music_albums') || Phpfox ::getUserParam('music.can_feature_music_albums')):  Phpfox::getBlock('core.moderation');  endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('music.no_albums_found'); ?>
</div>
<?php endif; ?>
