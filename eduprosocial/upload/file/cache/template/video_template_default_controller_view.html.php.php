<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: July 23, 2013, 4:06 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<div class="item_view">
	<div id="js_video_edit_form_outer" style="display:none;">
		<form method="post" action="#" onsubmit="$(this).ajaxCall('video.viewUpdate'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
			<div><input type="hidden" name="val[is_inline]" value="true" /></div>
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
	
<?php if ($this->_aVars['aVideo']['in_process'] > 0): ?>
		<div class="message">
<?php echo Phpfox::getPhrase('video.video_is_being_processed'); ?>
		</div>
<?php else: ?>
<?php if ($this->_aVars['aVideo']['view_id'] == 2): ?>
		<div class="message js_moderation_off" id="js_approve_video_message">
<?php echo Phpfox::getPhrase('video.video_is_pending_approval'); ?>
		</div>
<?php endif; ?>
<?php endif; ?>
	
<?php if (( ( $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('video.can_edit_own_video')) || Phpfox ::getUserParam('video.can_edit_other_video')) || ( ( $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('video.can_delete_own_video')) || Phpfox ::getUserParam('video.can_delete_other_video')) || ( Phpfox ::getUserParam('video.can_sponsor_video') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' ) ) || ( Phpfox ::getUserParam('video.can_approve_videos') && $this->_aVars['aVideo']['view_id'] == 2 )): ?>
		<div class="item_bar">
			<div class="item_bar_action_holder">
<?php if (( Phpfox ::getUserParam('video.can_approve_videos') && $this->_aVars['aVideo']['view_id'] == 2 )): ?>
				<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>			
				<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('video.approve', 'inline=true&amp;video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('video.approve'); ?></a>
<?php endif; ?>
<?php if ($this->_aVars['bCanDeleteVideo'] || $this->_aVars['bCanEditVideo']): ?>
				<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('video.actions'); ?></span></a>	
				<ul>
					<?php /* Cached: July 23, 2013, 4:06 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<?php if (( $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('video.can_edit_own_video')) || Phpfox ::getUserParam('video.can_edit_other_video')): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('video.edit', array('id' => $this->_aVars['aVideo']['video_id'])); ?>"><?php echo Phpfox::getPhrase('video.edit'); ?></a></li>
<?php endif; ?>
<?php if (( $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('video.can_delete_own_video')) || Phpfox ::getUserParam('video.can_delete_other_video')): ?>
		<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('video', array('delete' => $this->_aVars['aVideo']['video_id'])); ?>" class="sJsConfirm"><?php echo Phpfox::getPhrase('video.delete'); ?></a></li>
<?php endif; ?>

<?php if (Phpfox ::getUserParam('video.can_sponsor_video') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' )): ?>
		<li>
			<span id="js_sponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>" class="" style="<?php if ($this->_aVars['aVideo']['is_sponsor'] != 1): ?>display:none;<?php endif; ?>">
			    <a href="#" onclick="$('#js_sponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>').hide();$('#js_unsponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>').show();$.ajaxCall('video.sponsor','video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&type=0'); return false;">
<?php echo Phpfox::getPhrase('video.un_sponsor'); ?>
			    </a>
			</span>

			<span id="js_unsponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>" class="" style="<?php if ($this->_aVars['aVideo']['is_sponsor'] == 1): ?>display:none;<?php endif; ?>">
			    <a href="#" onclick="$('#js_sponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>').show();$('#js_unsponsor_<?php echo $this->_aVars['aVideo']['video_id']; ?>').hide();$.ajaxCall('video.sponsor','video_id=<?php echo $this->_aVars['aVideo']['video_id']; ?>&type=1'); return false;">
<?php echo Phpfox::getPhrase('video.sponsor'); ?>
			    </a>
			</span>
		</li>
<?php endif; ?>
		
<?php if (Phpfox ::getUserParam('video.can_purchase_sponsor') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' ) && $this->_aVars['aVideo']['user_id'] == Phpfox ::getUserId() && $this->_aVars['aVideo']['is_sponsor'] != 1): ?>
		    <li>
			<a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aVideo']['video_id'], null, false, null, (array) array (
)); ?>section_video/">
<?php echo Phpfox::getPhrase('video.sponsor'); ?>
			</a>
		    </li>
<?php endif; ?>
		
<?php (($sPlugin = Phpfox_Plugin::get('video.template_block_menu')) ? eval($sPlugin) : false); ?>
				</ul>			
<?php endif; ?>
			</div>
		</div>	
<?php endif; ?>
	
		<div class="t_center">
<?php if (! empty ( $this->_aVars['aVideo']['vidly_url_id'] )): ?>
<?php if ($this->_aVars['aVideo']['in_process'] == 0): ?>
		<iframe frameborder="0" width="640" height="390" name="vidly-frame" src="http://s.vid.ly/embeded.html?link=<?php echo $this->_aVars['aVideo']['vidly_url_id']; ?>&amp;width=640&amp;height=390&autoplay=false"></iframe>
<?php endif; ?>
<?php else: ?>
<?php if ($this->_aVars['aVideo']['is_stream']): ?>
<?php echo $this->_aVars['aVideo']['embed_code']; ?>
<?php else: ?>
		<div id="js_video_player" style="width:640px; height:390px; margin:auto;<?php if ($this->_aVars['aVideo']['in_process'] > 0): ?> display:none;<?php endif; ?>"></div>		
<?php endif; ?>
<?php endif; ?>
		</div>
		
<?php Phpfox::getBlock('video.detail', array()); ?>
		<div <?php if ($this->_aVars['aVideo']['view_id']): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
			
		<div class="video_rate_body">
			<div class="video_rate_display">
<?php Phpfox::getBlock('rate.display', array()); ?>
			</div>
<?php if (Phpfox ::isModule('share')): ?>
				<a href="#" class="video_view_embed"><?php echo Phpfox::getPhrase('video.embed'); ?></a>
				<div class="video_view_embed_holder">
					<input name="#" value="<?php echo $this->_aVars['aVideo']['embed']; ?>" type="text" size="22" onfocus="this.select();" style="width:490px;" />	
				</div>
<?php endif; ?>
		</div>				
		
<?php (($sPlugin = Phpfox_Plugin::get('video.template_default_controller_view_extra_info')) ? eval($sPlugin) : false); ?>
		
<?php Phpfox::getBlock('feed.comment', array()); ?>
		</div>
	</div>
</div>
