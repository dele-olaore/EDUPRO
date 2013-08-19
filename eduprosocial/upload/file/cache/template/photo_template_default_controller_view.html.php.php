<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 3, 2013, 12:34 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: view.html.php 4881 2012-10-11 04:49:16Z Raymond_Benc $
 */
 
 

?>
<div id="js_current_page_url" style="display:none;"><?php if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?></div>

<?php if (isset ( $this->_aVars['aForms']['view_id'] ) && $this->_aVars['aForms']['view_id'] == 1): ?>
<div class="message js_moderation_off">
<?php echo Phpfox::getPhrase('photo.image_is_pending_approval'); ?>
</div>
<?php endif;  if ($this->_aVars['bIsTheater'] && ! Phpfox ::isMobile()): ?>
<div id="photo_view_theater_mode" class="photo_view_box_holder">
	<div class="photo_view_in_photo">
		<b><?php echo Phpfox::getPhrase('photo.in_this_photo'); ?>:</b> <span id="js_photo_in_this_photo"></span>		
	</div>				
	
	<div id="js_photo_box_view_bottom_ad">
<?php Phpfox::getBlock('ad.display', array('block_id' => 'photo_theater')); ?>
				
		<a href="#" onclick="$('#js_photo_box_view_more').slideToggle(); return false;" class="photo_box_photo_detail"><?php echo Phpfox::getPhrase('photo.photo_details'); ?></a>
		<div id="js_photo_box_view_more">
			<div class="js_photo_box_view_more_padding">
<?php Phpfox::getBlock('photo.detail', array('is_in_photo' => true)); ?>
			</div>
		</div>									
	</div>
	
	<div class="photo_view_box_comment">			
		<div class="photo_view_box_comment_padding">
			<div id="js_photo_view_box_title">
				<div class="row_title">
					<div class="row_title_image">
						<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aForms']['user_name']); ?>" class="no_ajax_link"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aForms'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50,'no_link' => true)); ?></a>
					</div>
					<div class="row_title_info" style="position:relative;">					
						<div class="photo_view_box_user"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl($this->_aVars['aForms']['user_name']); ?>" class="no_ajax_link"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForms']['full_name'], 50); ?></a></div>
						<ul class="extra_info_middot">
							<li><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aForms']['time_stamp']); ?></li>
<?php if (! empty ( $this->_aVars['aForms']['album_id'] )): ?>
							<li>&middot;</li>
							<li><?php echo Phpfox::getPhrase('photo.in'); ?> <a href="<?php echo $this->_aVars['aForms']['album_url']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['album_title']), 45), 75, '...'); ?></a> </li>						
<?php endif; ?>
						</ul>
					</div>
				</div>
				
<?php if (( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo') || ( Phpfox ::getUserParam('photo.can_delete_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_delete_other_photos')): ?>
				<div class="item_bar">
					<div class="item_bar_action_holder">
<?php if ($this->_aVars['aForms']['view_id'] == '1' && Phpfox ::getUserParam('photo.can_approve_photos')): ?>
							<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>
							<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('photo.approve', 'inline=true&amp;id=<?php echo $this->_aVars['aForms']['photo_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('photo.approve'); ?></a>
<?php endif; ?>
						<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('photo.actions'); ?></span></a>		
						<ul>
<?php Phpfox::getBlock('photo.menu', array()); ?>
						</ul>			
					</div>		
				</div>	    
<?php endif; ?>
				
<?php if ($this->_aVars['aForms']['description']): ?>
				<div id="js_photo_description_<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="extra_info">
<?php echo (Phpfox::isModule('emoticon') ? Phpfox::getService('emoticon')->parse(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']), 200, 'photo.read_more', true)) : Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']), 200, 'photo.read_more', true)); ?>
				</div>
<?php endif; ?>
			</div>
					
<?php if (Phpfox ::isModule('tag') && isset ( $this->_aVars['aForms']['tag_list'] )): ?>
<?php Phpfox::getBlock('tag.item', array('sType' => 'photo','sTags' => $this->_aVars['aForms']['tag_list'],'iItemId' => $this->_aVars['aForms']['photo_id'],'iUserId' => $this->_aVars['aForms']['user_id'])); ?>
<?php endif; ?>
						
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_default_controller_view_extra_info')) ? eval($sPlugin) : false); ?>
			
			<div id="js_photo_view_comment_holder" <?php if ($this->_aVars['aForms']['view_id'] != 0): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
<?php Phpfox::getBlock('feed.comment', array()); ?>
			</div>	
		</div>
	</div>

	<div class="photo_view_box_image photo_holder_image" <?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>onclick="tb_show('', '<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>', this);" rel="<?php echo $this->_aVars['aPhotoStream']['next']['photo_id']; ?>"<?php endif; ?>>		
		 <div id="photo_view_tag_photo">
			<a href="#" id="js_tag_photo"><?php echo Phpfox::getPhrase('photo.tag_this_photo'); ?></a>
		</div>
		<div id="photo_view_ajax_loader"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/loader.gif')); ?></div>
<?php if ($this->_aVars['aPhotoStream']['total'] > 1): ?>
			<div class="photo_next_previous">
				<ul>
<?php if (isset ( $this->_aVars['aPhotoStream']['previous']['photo_id'] )): ?>
				<li class="previous"><a href="<?php echo $this->_aVars['aPhotoStream']['previous']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['previous']['photo_id']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('photo.previous'); ?></a></li>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				<li class="next"><a href="<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['next']['photo_id']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('photo.next'); ?></a></li>
<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
<?php endif; ?>
		
			<div class="photo_view_box_image_holder" style="position:absolute;">			
<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				<a href="<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['next']['photo_id']; ?>"<?php endif; ?>>
<?php endif; ?>
<?php if ($this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('style' => "display:none;",'id' => 'js_photo_view_image_small','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_500','max_width' => 500,'max_height' => 500,'title' => $this->_aVars['aForms']['title'],'time_stamp' => true,'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('style' => "display:none;",'id' => 'js_photo_view_image_small','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_500','max_width' => 500,'max_height' => 500,'title' => $this->_aVars['aForms']['title'],'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php endif; ?>
				
<?php if ($this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_1024','max_width' => 1024,'max_height' => 1024,'title' => $this->_aVars['aForms']['title'],'time_stamp' => true,'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_1024','max_width' => 1024,'max_height' => 1024,'title' => $this->_aVars['aForms']['title'],'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				</a>
<?php endif; ?>
			</div>
		</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
$Behavior.autoLoadPhoto = function(){
	
	<?php echo '
	// $(\'#main_core_body_holder\').hide();
	
	$(\'#photo_view_ajax_loader\').hide();
	$(\'.js_box_image_holder_full\').find(\'.js_box\').show();
	$(\'.js_box_image_holder_full\').find(\'.js_box\').width($(window).width() - 40);
	$(\'.js_box_image_holder_full\').find(\'.js_box_content\').height(getPageHeight() - 70);		
	$(\'.js_box_image_holder_full\').css(\'position\', \'fixed\');
	
	var iCommentBoxMaxHeight = 300;

	iCommentBoxMaxHeight = (($(\'.js_box_image_holder_full\').find(\'.js_box_content\').height() - ($(\'#js_photo_view_box_title\').height() + $(\'#js_photo_box_view_bottom_ad\').height())) - ($Core.exists(\'#js_ad_space_photo_theater\') ? 220 : 235));	
	if (!$Core.exists(\'#js_ad_space_photo_theater\')){
		// iCommentBoxMaxHeight = iCommentBoxMaxHeight - 150;
	}
	
	$(\'.js_box_image_holder_full\').find(\'.js_feed_comment_view_more_holder:first\').css({
		\'max-height\': iCommentBoxMaxHeight + \'px\',
		overflow: \'auto\'
	});		
		
	$(\'.photo_view_box_comment\').css(\'min-height\', $(\'.js_box_image_holder_full\').find(\'.js_box\').height());	
	$(\'.js_box_image_holder_full\').find(\'.js_box\').css({
		\'top\': 0,
		\'left\': \'16px\'	    		
	});

	if ($(\'#js_photo_view_image\').height() >= $(\'.js_box_image_holder_full\').find(\'.js_box_content\').height()){
		$(\'.photo_view_box_image_holder\').css({top: 0});
	}
	else {
		$(\'.photo_view_box_image_holder\').css({
			top: \'50%\',
			\'margin-top\': \'-\' + ($(\'#js_photo_view_image\').height() / 2) + \'px\',		
		});
	}
	
	$(\'.photo_view_box_image_holder\').css({
		left: \'50%\',
		\'margin-left\': \'-\' + ($(\'#js_photo_view_image\').width() / 2) + \'px\'		
	});			
   
	$(\'.js_box_image_holder_full_loader\').hide();
	
	$(\'.photo_view_box_image\').height($(\'.js_box_image_holder_full\').find(\'.js_box_content\').height());
	$(\'#photo_view_theater_mode\').find(\'.js_comment_feed_textarea:first\').focus(function(){
		$(this).height(50);
		$(\'#js_ad_space_photo_theater\').hide();
		$(this).addClass(\'no_resize_textarea\');
		return true;
	});

	if ($(\'#js_photo_view_image\').height() >= $(\'.js_box\').height() || $(\'#js_photo_view_image\').width() >= ($(\'.js_box\').width() - 420)){
		$(\'#js_photo_view_image\').hide();
		$(\'#js_photo_view_image_small\').show();

		$(\'.photo_view_box_image_holder\').css({
			left: \'50%\',
			top: \'50%\',
			\'margin-left\': \'-\' + ($(\'#js_photo_view_image_small\').width() / 2) + \'px\',
			\'margin-top\': \'-\' + ($(\'#js_photo_view_image_small\').height() / 2) + \'px\'		
		});	
	}
	
	'; ?>

	
	$Core.photo_tag.init({<?php echo $this->_aVars['sPhotoJsContent']; ?>});
	$Behavior.autoLoadPhoto = function(){}
}
</script>
			
<?php else: ?>
<div class="item_view photo_item_view" <?php if ($this->_aVars['bIsTheater']): ?> id="photo_view_theater_mode"<?php endif; ?>>
	<div id="js_album_outer_content">
		
<?php if (! $this->_aVars['bIsTheater']): ?>
	    <div class="item_info">
<?php echo Phpfox::getPhrase('photo.time_stamp_by_full_name', array('time_stamp' => Phpfox::getLib('date')->convertTime($this->_aVars['aForms']['time_stamp']),'full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aForms']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aForms']['user_name'], ((empty($this->_aVars['aForms']['user_name']) && isset($this->_aVars['aForms']['profile_page_id'])) ? $this->_aVars['aForms']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForms']['full_name'], 35, '...') . '</a></span>')); ?>
<?php if (! empty ( $this->_aVars['aForms']['album_id'] )): ?> <br /> <?php echo Phpfox::getPhrase('photo.in'); ?> <a href="<?php echo $this->_aVars['aForms']['album_url']; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['album_title']), 45), 75, '...'); ?></a><?php endif; ?>
	    </div>
<?php endif; ?>
<?php if (( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo') || ( Phpfox ::getUserParam('photo.can_delete_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_delete_other_photos')): ?>
		<div class="item_bar">
			<div class="item_bar_action_holder">
<?php if ($this->_aVars['aForms']['view_id'] == '1' && Phpfox ::getUserParam('photo.can_approve_photos')): ?>
					<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>
					<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('photo.approve', 'inline=true&amp;id=<?php echo $this->_aVars['aForms']['photo_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('photo.approve'); ?></a>
<?php endif; ?>
				<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('photo.actions'); ?></span></a>		
				<ul>
					<?php /* Cached: June 3, 2013, 12:34 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: menu.html.php 4780 2012-09-27 08:11:52Z Raymond_Benc $
 */
 
 

?>
<?php if (( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo')): ?>
		<li><a href="#" onclick="if ($Core.exists('.js_box_image_holder_full')) { js_box_remove($('.js_box_image_holder_full').find('.js_box_content')); } $Core.box('photo.editPhoto', 700, 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>'); $('#js_tag_photo').hide();return false;"><?php echo Phpfox::getPhrase('photo.edit_this_photo'); ?></a></li>
<?php endif; ?>
		
<?php if ($this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()): ?>
			<li>
				<a href="#" title="Set this photo as your profile image." onclick="if ($Core.exists('.js_box_image_holder_full')) { js_box_remove($('.js_box_image_holder_full').find('.js_box_content')); } tb_show('', '', null, '<?php echo Phpfox::getPhrase('photo.setting_this_photo_as_your_profile_picture_please_hold'); ?>', true); $.ajaxCall('photo.makeProfilePicture', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.make_profile_picture'); ?></a>
			</li>
<?php if (Phpfox ::getUserParam('profile.can_change_cover_photo')): ?>
				<li>
					<a href="#" title="<?php echo Phpfox::getPhrase('user.set_this_photo_as_your_profile_cover_photo'); ?>" onclick="$.ajaxCall('user.setCoverPhoto', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('user.set_as_cover_photo'); ?></a>
				</li>
<?php endif; ?>
<?php endif; ?>
		
<?php if (Phpfox ::getUserParam('photo.can_feature_photo') && ! $this->_aVars['aForms']['is_sponsor']): ?>
		    <li id="js_photo_feature_<?php echo $this->_aVars['aForms']['photo_id']; ?>">
<?php if ($this->_aVars['aForms']['is_featured']): ?>
			    <a href="#" title="<?php echo Phpfox::getPhrase('photo.un_feature_this_photo'); ?>" onclick="$.ajaxCall('photo.feature', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;type=0', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.un_feature'); ?></a>
<?php else: ?>
			    <a href="#" title="<?php echo Phpfox::getPhrase('photo.feature_this_photo'); ?>" onclick="$.ajaxCall('photo.feature', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;type=1', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.feature'); ?></a>
<?php endif; ?>
		    </li>
<?php endif; ?>

<?php if (Phpfox ::getUserParam('photo.can_sponsor_photo') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' )): ?>
		<li id="js_sponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="" style="<?php if ($this->_aVars['aForms']['is_sponsor']): ?>display:none;<?php endif; ?>">
			    <a href="#" onclick="$('#js_sponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>').hide();$('#js_unsponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>').show();$.ajaxCall('photo.sponsor','photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&type=1'); return false;">
<?php echo Phpfox::getPhrase('photo.sponsor_this_photo'); ?>
			    </a>
		</li>		    
		<li id="js_unsponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="" style="<?php if ($this->_aVars['aForms']['is_sponsor'] != 1): ?>display:none;<?php endif; ?>">
			    <a href="#" onclick="$('#js_sponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>').show();$('#js_unsponsor_<?php echo $this->_aVars['aForms']['photo_id']; ?>').hide();$.ajaxCall('photo.sponsor','photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&type=0'); return false;">
<?php echo Phpfox::getPhrase('photo.unsponsor_this_photo'); ?>
			    </a>
		</li>
<?php elseif (Phpfox ::getUserParam('photo.can_purchase_sponsor') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' ) && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId() && $this->_aVars['aForms']['is_sponsor'] != 1): ?>
		    <li>
			<a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aForms']['photo_id'], null, false, null, (array) array (
)); ?>section_photo/">
<?php echo Phpfox::getPhrase('photo.sponsor_this_photo'); ?>
			</a>
		    </li>
<?php endif; ?>
		
<?php if (PHPFOX_IS_AJAX && isset ( $this->_aVars['bIsTheater'] ) && $this->_aVars['bIsTheater'] && ( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo')): ?>
					<li>
						<a href="#" onclick="$('#photo_view_ajax_loader').show(); $('#menu').remove(); $('#noteform').hide(); $('#js_photo_view_image').imgAreaSelect({ hide: true }); $('#js_photo_view_holder').hide(); $.ajaxCall('photo.rotate', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;photo_cmd=right&amp;currenturl=' + $('#js_current_page_url').html()); return false;">
<?php echo Phpfox::getPhrase('photo.rotate_right'); ?>
						</a>
					</li>
					<li>
						<a href="#" onclick="$('#photo_view_ajax_loader').show(); $('#menu').remove(); $('#noteform').hide(); $('#js_photo_view_image').imgAreaSelect({ hide: true }); $('#js_photo_view_holder').hide(); $.ajaxCall('photo.rotate', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;photo_cmd=left&amp;currenturl=' + $('#js_current_page_url').html()); return false;">		<?php echo Phpfox::getPhrase('photo.rotate_left'); ?>							
						</a>
					</li>		
<?php endif; ?>
		
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_block_menu')) ? eval($sPlugin) : false); ?>
		
<?php if (( Phpfox ::getUserParam('photo.can_delete_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_delete_other_photos')): ?>
		<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo', array('delete' => $this->_aVars['aForms']['photo_id'])); ?>" class="sJsConfirm"><?php echo Phpfox::getPhrase('photo.delete_this_photo'); ?></a></li>
<?php endif; ?>
		
<?php if (isset ( $this->_aVars['aCallback'] )): ?>
			<li>
				<a href="#" onclick="$Core.Photo.setCoverPhoto(<?php echo $this->_aVars['aForms']['photo_id']; ?>,<?php echo $this->_aVars['aCallback']['item_id']; ?>); return false;" >
					Set as Page's Cover Photo
				</a>
			</li>
<?php endif; ?>
				</ul>			
			</div>		
		</div>	    
<?php endif; ?>
	
		<div class="t_center" id="js_photo_view_holder_process"></div>
		<div id="js_photo_view_main_holder"<?php if (! Phpfox ::isMobile()): ?> style="margin-bottom:30px;"<?php endif; ?>>
			<div class="t_center" id="js_photo_view_holder">
			
<?php if ($this->_aVars['aPhotoStream']['total'] > 1 && $this->_aVars['bIsTheater']): ?>
		    <div class="photo_next_previous">
				<ul>
<?php if (isset ( $this->_aVars['aPhotoStream']['previous']['photo_id'] )): ?>
				<li class="previous"><a href="<?php echo $this->_aVars['aPhotoStream']['previous']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['previous']['photo_id']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('photo.previous'); ?></a></li>
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				<li class="next"><a href="<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['next']['photo_id']; ?>"<?php endif; ?>><?php echo Phpfox::getPhrase('photo.next'); ?></a></li>
<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
<?php endif; ?>
		
			
<?php if (( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo')): ?>
				<div class="photo_rotate">
					<ul>					
						<li>
							<a href="#" onclick="$('#menu').remove(); $('#noteform').hide(); $('#js_photo_view_image').imgAreaSelect({ hide: true }); $('#js_photo_view_holder').hide(); $('#js_photo_view_holder_process').html($.ajaxProcess('', 'large')).height($('#js_photo_view_holder').height()).show(); $.ajaxCall('photo.rotate', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;photo_cmd=left&amp;currenturl=' + $('#js_current_page_url').html()); return false;" class="left js_hover_title">
								<span class="js_hover_info">
<?php echo Phpfox::getPhrase('photo.rotate_left'); ?>
								</span></a>
						</li>
						<li>
							<a href="#" onclick="$('#menu').remove(); $('#noteform').hide(); $('#js_photo_view_image').imgAreaSelect({ hide: true }); $('#js_photo_view_holder').hide(); $('#js_photo_view_holder_process').html($.ajaxProcess('', 'large')).height($('#js_photo_view_holder').height()).show(); $.ajaxCall('photo.rotate', 'photo_id=<?php echo $this->_aVars['aForms']['photo_id']; ?>&amp;photo_cmd=right&amp;currenturl=' + $('#js_current_page_url').html()); return false;" class="right js_hover_title"><span class="js_hover_info"><?php echo Phpfox::getPhrase('photo.rotate_right'); ?></span></a>
						</li>
					</ul>
					<div class="clear"></div>
				</div>
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				<a href="<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"<?php if ($this->_aVars['bIsTheater']): ?> class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhotoStream']['next']['photo_id']; ?>"<?php endif; ?>>
<?php endif; ?>
<?php if (Phpfox ::isMobile()): ?>
<?php if ($this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_500','max_width' => 285,'max_height' => 300,'title' => $this->_aVars['aForms']['title'],'time_stamp' => true,'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_500','max_width' => 285,'max_height' => 300,'title' => $this->_aVars['aForms']['title'],'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php endif; ?>
<?php else: ?>
<?php if ($this->_aVars['aForms']['user_id'] == Phpfox ::getUserId()): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_1024','max_width' => 1024,'max_height' => 1024,'title' => $this->_aVars['aForms']['title'],'time_stamp' => true,'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php else: ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('id' => 'js_photo_view_image','server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_1024','max_width' => 1024,'max_height' => 1024,'title' => $this->_aVars['aForms']['title'],'onmouseover' => "$('.photo_next_previous .next a').addClass('is_hover_active');",'onmouseout' => "$('.photo_next_previous .next a').removeClass('is_hover_active');")); ?>
<?php endif; ?>
					<script type="text/javascript">
					$Behavior.autoLoadFullPhoto = function(){
	
						var sImageHeight = $('#js_photo_view_image').height();
						var sImageWidth = $('#js_photo_view_image').width();
	
						$('#js_photo_view_holder').css({
							'position': 'absolute',
							'left': '50%',
							'margin-left': '-' + (sImageWidth / 2) + 'px'						
						});

						$('#js_photo_view_main_holder').css('height', sImageHeight);
						
						
							
						$Behavior.autoLoadFullPhoto = function(){}
					}
					</script>
<?php endif; ?>
				
<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
				</a>
<?php endif; ?>
			
			</div>
		</div>
		
<?php if (! $this->_aVars['bIsTheater']): ?>
<?php if ($this->_aVars['aPhotoStream']['total'] > 1): ?>
	    <div class="photo_next_previous">
			<ul>
<?php if (! Phpfox ::isMobile()): ?>
			<li class="photo_stream_info"><?php echo Phpfox::getPhrase('photo.photo_current_of_total', array('current' => $this->_aVars['aPhotoStream']['current'],'total' => $this->_aVars['aPhotoStream']['total'])); ?></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPhotoStream']['previous']['photo_id'] )): ?>
			<li class="previous"><a href="<?php echo $this->_aVars['aPhotoStream']['previous']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"><?php echo Phpfox::getPhrase('photo.previous'); ?></a></li>
<?php endif; ?>
		
<?php if (isset ( $this->_aVars['aPhotoStream']['next']['photo_id'] )): ?>
			<li class="next"><a href="<?php echo $this->_aVars['aPhotoStream']['next']['link'];  if ($this->_aVars['iForceAlbumId'] > 0): ?>albumid_<?php echo $this->_aVars['iForceAlbumId'];  else:  if (isset ( $this->_aVars['feedUserId'] )): ?>userid_<?php echo $this->_aVars['feedUserId']; ?>/<?php endif;  endif; ?>"><?php echo Phpfox::getPhrase('photo.next'); ?></a></li>
<?php endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
<?php endif; ?>
<?php endif; ?>
		
<?php if (! Phpfox ::isMobile()): ?>
		<div class="photo_view_ad">
<?php Phpfox::getBlock('ad.display', array('block_id' => 'photo_theater')); ?>
		</div>
		
		<div class="photo_view_detail" style="padding-top:10px;">			
<?php Phpfox::getBlock('photo.detail', array()); ?>
		</div>	
		
		<div class="photo_view_comment">
<?php endif; ?>
<?php if ($this->_aVars['aForms']['description']): ?>
			<div id="js_photo_description_<?php echo $this->_aVars['aForms']['photo_id']; ?>">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']), 200, 'photo.read_more', true); ?>
			</div>
<?php endif; ?>
			
			<div class="extra_info" style="display:none;">
				<b><?php echo Phpfox::getPhrase('photo.in_this_photo'); ?>:</b> <span id="js_photo_in_this_photo"></span>
			</div>		
		
<?php if (Phpfox ::isModule('tag') && isset ( $this->_aVars['aForms']['tag_list'] )): ?>
<?php Phpfox::getBlock('tag.item', array('sType' => 'photo','sTags' => $this->_aVars['aForms']['tag_list'],'iItemId' => $this->_aVars['aForms']['photo_id'],'iUserId' => $this->_aVars['aForms']['user_id'])); ?>
<?php endif; ?>
			
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_default_controller_view_extra_info')) ? eval($sPlugin) : false); ?>
			
			<div style="<?php if ($this->_aVars['aForms']['view_id'] != 0): ?>display:none;<?php endif; ?>" class="js_moderation_on">
<?php Phpfox::getBlock('feed.comment', array()); ?>
			</div>	
<?php if (! Phpfox ::isMobile()): ?>
		</div>	
<?php endif; ?>
		<div class="clear"></div>
		
	</div>
</div>
<script type="text/javascript">$Behavior.tagPhoto = function() { $Core.photo_tag.init({<?php echo $this->_aVars['sPhotoJsContent']; ?>}); }
$Behavior.removeTagBox = function() 
{ 
<?php echo ''; ?>

}

</script>
<?php endif; ?>
