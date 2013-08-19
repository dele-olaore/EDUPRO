<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 29, 2013, 3:04 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Video
 * @version 		$Id: index.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

 if (! count ( $this->_aVars['aVideos'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('video.no_videos_found'); ?>
</div>
<?php else: ?>
<div id="js_video_edit_form_outer" style="display:none;">
	<form method="post" action="#" onsubmit="$(this).ajaxCall('video.viewUpdate'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div id="js_video_edit_form"></div>
		<div class="table_clear">
			<ul class="table_clear_button">
				<li><input type="submit" value="<?php echo Phpfox::getPhrase('video.update'); ?>" class="button" /></li>
				<li><a href="#" id="js_video_go_advanced" class="button_off_link"><?php echo Phpfox::getPhrase('video.go_advanced_uppercase'); ?></a></li>
				<li><a href="#" onclick="$('#js_video_edit_form_outer').hide(); $('#js_video_outer_body').show(); return false;" class="button_off_link"><?php echo Phpfox::getPhrase('video.cancel_uppercase'); ?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	
</form>

</div>

<div id="js_video_outer_body">
<?php if (count((array)$this->_aVars['aVideos'])):  $this->_aPhpfoxVars['iteration']['videos'] = 0;  foreach ((array) $this->_aVars['aVideos'] as $this->_aVars['aVideo']):  $this->_aPhpfoxVars['iteration']['videos']++; ?>

		<?php /* Cached: May 29, 2013, 3:04 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Video
 * @version 		$Id: index.html.php 520 2009-05-13 14:57:05Z Raymond_Benc $
 */
 
 

 (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_1')) ? eval($sPlugin) : false); ?>
	<div class="js_video_parent main_video_div_container <?php if (isset ( $this->_aVars['aVideo']['is_sponsor'] ) && $this->_aVars['aVideo']['is_sponsor']): ?>row_sponsored_image<?php endif; ?> <?php if (isset ( $this->_aVars['aVideo']['is_featured'] ) && $this->_aVars['aVideo']['is_featured']): ?>row_featured_image<?php endif; ?>" id="js_video_id_<?php echo $this->_aVars['aVideo']['video_id']; ?>">	
		<div class="video_width_holder">
			<div class="video_height_holder">
				<div class="js_outer_video_div js_mp_fix_holder image_hover_holder">
<?php if (( ( Phpfox ::getUserParam('video.can_edit_own_video') && $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('video.can_edit_other_video')) || ( ( Phpfox ::getUserParam('video.can_delete_own_video') && $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('video.can_delete_other_video')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
					<a href="#" class="image_hover_menu_link"><?php echo Phpfox::getPhrase('video.link'); ?></a>
					<div class="image_hover_menu">
						<ul>
<?php if (( ( Phpfox ::getUserParam('video.can_delete_own_video') && $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('video.can_delete_other_video')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
							<li class="item_delete"><a href="#" title="<?php echo Phpfox::getPhrase('video.delete_this_video'); ?>" onclick="if (confirm('<?php echo Phpfox::getPhrase('video.are_you_sure', array('phpfox_squote' => true)); ?>')) $.ajaxCall('video.delete', 'video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('video.delete'); ?></a></li>
<?php endif; ?>
						
<?php if (! defined ( 'PHPFOX_IS_PAGES_VIEW' )): ?>
<?php if (Phpfox ::getUserParam('video.can_sponsor_video')): ?>
							<li id="js_video_sponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>">
<?php if ($this->_aVars['aVideo']['is_sponsor']): ?>
								<a href="#" title="<?php echo Phpfox::getPhrase('video.unsponsor_this_video'); ?>" onclick="$.ajaxCall('video.sponsor', 'video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&amp;type=0'); return false;">
<?php echo Phpfox::getPhrase('video.un_sponsor'); ?>
								</a>
<?php else: ?>
								<a href="#" title="<?php echo Phpfox::getPhrase('video.sponsor_this_video'); ?>" onclick="$.ajaxCall('video.sponsor', 'video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&amp;type=1'); return false;">
<?php echo Phpfox::getPhrase('video.sponsor'); ?>
								</a>
<?php endif; ?>
							</li>
<?php endif; ?>
<?php if ($this->_aVars['aVideo']['view_id'] != 2): ?>
<?php if (Phpfox ::getUserParam('video.can_feature_videos_')): ?>
							<li id="js_feature_<?php echo $this->_aVars['aVideo']['video_id']; ?>"<?php if ($this->_aVars['aVideo']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" title="<?php echo Phpfox::getPhrase('video.feature_this_video'); ?>" onclick="$(this).parent().hide(); $('#js_unfeature_<?php echo $this->_aVars['aVideo']['video_id']; ?>').show(); $(this).parents('.js_video_parent:first').addClass('row_featured_image').find('.js_featured_video:first').show(); $.ajaxCall('video.feature', 'video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('video.feature'); ?></a></li>
							<li id="js_unfeature_<?php echo $this->_aVars['aVideo']['video_id']; ?>"<?php if (! $this->_aVars['aVideo']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" title="<?php echo Phpfox::getPhrase('video.un_feature_this_video'); ?>" onclick="$(this).parent().hide(); $('#js_feature_<?php echo $this->_aVars['aVideo']['video_id']; ?>').show(); $(this).parents('.js_video_parent:first').removeClass('row_featured_image').find('.js_featured_video:first').hide(); $.ajaxCall('video.feature', 'video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&amp;type=0'); return false;"><?php echo Phpfox::getPhrase('video.un_feature'); ?></a></li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (( Phpfox ::getUserParam('video.can_edit_own_video') && $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('video.can_edit_other_video')): ?>
							<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('video.edit', array('id' => $this->_aVars['aVideo']['video_id'])); ?>" title="<?php echo Phpfox::getPhrase('video.edit_this_video'); ?>"><?php echo Phpfox::getPhrase('video.edit'); ?></a></li>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_3')) ? eval($sPlugin) : false); ?>
						</ul>
					</div>				
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aVideo']['duration'] )): ?>
					<div class="video_duration">
<?php echo $this->_aVars['aVideo']['duration']; ?>
					</div>
<?php endif; ?>
			
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_2')) ? eval($sPlugin) : false); ?>
<?php if (isset ( $this->_aVars['sPublicPhotoView'] ) && $this->_aVars['sPublicPhotoView'] == 'featured'): ?>
<?php else: ?>
					<div class="js_featured_video row_featured_link"<?php if (! $this->_aVars['aVideo']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('video.featured'); ?>
					</div>					
<?php endif; ?>
					<div class="row_pending_link"<?php if ($this->_aVars['aVideo']['view_id'] != 2): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('video.pending'); ?>
					</div>
					<div class="js_sponsor_video row_sponsored_link"<?php if (! $this->_aVars['aVideo']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('video.sponsored'); ?>
					</div>					
					
<?php if (Phpfox ::getUserParam('video.can_approve_videos') || Phpfox ::getUserParam('video.can_delete_other_video')): ?>
					<div class="video_moderate_link"><a href="#<?php echo $this->_aVars['aVideo']['video_id']; ?>" class="moderate_link" rel="video"><?php echo Phpfox::getPhrase('video.moderate'); ?></a></div>				
<?php endif; ?>
					<a href="<?php echo $this->_aVars['aVideo']['link']; ?>" class="js_video_title_<?php echo $this->_aVars['aVideo']['video_id']; ?>">
<?php if (file_exists ( sprintf ( $this->_aVars['aVideo']['image_path'] , '_12090' ) )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aVideo']['image_server_id'],'path' => 'video.url_image','file' => $this->_aVars['aVideo']['image_path'],'suffix' => '_12090','max_width' => 120,'max_height' => 90,'class' => 'js_mp_fix_width video_image_border','title' => $this->_aVars['aVideo']['title'])); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aVideo']['image_server_id'],'path' => 'video.url_image','file' => $this->_aVars['aVideo']['image_path'],'suffix' => '_120','max_width' => 120,'max_height' => 90,'class' => 'js_mp_fix_width video_image_border','title' => $this->_aVars['aVideo']['title'])); ?>
<?php endif; ?>
					</a>				
				</div>
			</div>			
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_4')) ? eval($sPlugin) : false); ?>
			<a href="<?php echo $this->_aVars['aVideo']['link']; ?>" class="row_sub_link js_video_title_<?php echo $this->_aVars['aVideo']['video_id']; ?>" id="js_video_title_<?php echo $this->_aVars['aVideo']['video_id']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aVideo']['title']), 30, '...'), 20); ?></a>
			<div class="extra_info_link">
<?php if (isset ( $this->_aVars['sPublicPhotoView'] ) && $this->_aVars['sPublicPhotoView'] == 'most-discussed'): ?>
<?php echo Phpfox::getPhrase('video.comments_total_comment', array('total_comment' => $this->_aVars['aVideo']['total_comment'])); ?><br />
<?php elseif (isset ( $this->_aVars['sPublicPhotoView'] ) && $this->_aVars['sPublicPhotoView'] == 'popular'): ?>
<?php echo Phpfox::getPhrase('video.total_score_out_of_10', array('total_score' => round($this->_aVars['aVideo']['total_score']))); ?> <br />
<?php else: ?>
<?php if (! empty ( $this->_aVars['aVideo']['total_view'] ) && $this->_aVars['aVideo']['total_view'] > 0): ?>
<?php if ($this->_aVars['aVideo']['total_view'] == 1): ?>
<?php echo Phpfox::getPhrase('video.1_view'); ?><br />
<?php else: ?>
<?php echo Phpfox::getPhrase('video.total_views', array('total' => $this->_aVars['aVideo']['total_view'])); ?><br />
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if (! defined ( 'PHPFOX_IS_USER_PROFILEs' )): ?>
<?php echo Phpfox::getPhrase('video.by_full_name', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aVideo']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aVideo']['user_name'], ((empty($this->_aVars['aVideo']['user_name']) && isset($this->_aVars['aVideo']['profile_page_id'])) ? $this->_aVars['aVideo']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aVideo']['full_name'], 20, '...') . '</a></span>')); ?>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_5')) ? eval($sPlugin) : false); ?>
			</div>			
		</div>
	</div>
<?php if (Phpfox ::isMobile() || is_int ( $this->_aPhpfoxVars['iteration']['videos'] / 3 )): ?>
	<div class="clear"></div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_entry_6')) ? eval($sPlugin) : false); ?>
<?php endforeach; endif; ?>
	<div class="clear"></div>
<?php if (Phpfox ::getUserParam('video.can_approve_videos') || Phpfox ::getUserParam('video.can_delete_other_video')): ?>
<?php Phpfox::getBlock('core.moderation'); ?>
<?php endif; ?>
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
</div>
<?php endif; ?>
