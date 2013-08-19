<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:55 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Event
 * @version 		$Id: index.html.php 3737 2011-12-09 07:50:12Z Raymond_Benc $
 */
 
 

 if (! count ( $this->_aVars['aEvents'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('event.no_events_found'); ?>
</div>
<?php else: ?>

<?php if (count((array)$this->_aVars['aEvents'])):  foreach ((array) $this->_aVars['aEvents'] as $this->_aVars['sDate'] => $this->_aVars['aGroups']): ?>
<div class="block">
	<div class="title"><?php echo $this->_aVars['sDate']; ?></div>	
	<div class="border">
		<div class="content">
<?php if (count((array)$this->_aVars['aGroups'])):  $this->_aPhpfoxVars['iteration']['events'] = 0;  foreach ((array) $this->_aVars['aGroups'] as $this->_aVars['aEvent']):  $this->_aPhpfoxVars['iteration']['events']++; ?>

			<div id="js_event_item_holder_<?php echo $this->_aVars['aEvent']['event_id']; ?>" class="js_event_parent <?php if ($this->_aVars['aEvent']['is_sponsor'] && ! defined ( 'PHPFOX_IS_GROUP_VIEW' )): ?>row_sponsored <?php elseif ($this->_aVars['aEvent']['is_featured'] && $this->_aVars['sView'] != 'featured'): ?>row_featured <?php endif;  if (is_int ( $this->_aPhpfoxVars['iteration']['events'] )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['events'] == 1): ?> row_first<?php endif; ?>">
<?php if (! Phpfox ::isMobile()): ?>
				<div class="row_title_image_header">
					
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'): ?>
<?php else: ?>
					<div class="js_featured_event row_featured_link"<?php if (! $this->_aVars['aEvent']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('event.featured'); ?>
					</div>					
<?php endif; ?>
					<div id="js_sponsor_phrase_<?php echo $this->_aVars['aEvent']['event_id']; ?>" class="js_sponsor_event row_sponsored_link"<?php if (! $this->_aVars['aEvent']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('event.sponsored'); ?>
					</div>					
					
					<a href="<?php echo $this->_aVars['aEvent']['url']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aEvent']['server_id'],'title' => $this->_aVars['aEvent']['title'],'path' => 'event.url_image','file' => $this->_aVars['aEvent']['image_path'],'suffix' => '_120','max_width' => '120','max_height' => '120')); ?></a>
				</div>				
				<div class="row_title_image_header_body">	
<?php endif; ?>
					<div class="row_title">	

						<div class="row_title_image">		
							<a href="<?php echo $this->_aVars['aEvent']['url']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aEvent'],'suffix' => '_50_square','max_width' => '50','max_height' => '50')); ?></a>
<?php if (( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event') || ( $this->_aVars['aEvent']['view_id'] == 0 && ( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event')) || ( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event') || ( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_delete_own_event')) || Phpfox ::getUserParam('event.can_delete_other_event') || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
							<div class="row_edit_bar_parent">
								<div class="row_edit_bar_holder">
									<ul>
										<?php /* Cached: May 28, 2013, 11:55 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: menu.html.php 3737 2011-12-09 07:50:12Z Raymond_Benc $
 */
 
 

?>
<?php if (( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event')): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event.add', array('id' => $this->_aVars['aEvent']['event_id'])); ?>"><?php echo Phpfox::getPhrase('event.edit_event'); ?></a></li>	
<?php endif; ?>
<?php if ($this->_aVars['aEvent']['view_id'] == 0 && ( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event')): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event.add.invite', array('id' => $this->_aVars['aEvent']['event_id'])); ?>"><?php echo Phpfox::getPhrase('event.invite_people_to_come'); ?></a></li>	
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event.add.email', array('id' => $this->_aVars['aEvent']['event_id'])); ?>"><?php echo Phpfox::getPhrase('event.mass_email_guests'); ?></a></li>	
<?php endif; ?>
<?php if (( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_edit_own_event')) || Phpfox ::getUserParam('event.can_edit_other_event')): ?>
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event.add.manage', array('id' => $this->_aVars['aEvent']['event_id'])); ?>"><?php echo Phpfox::getPhrase('event.manage_guest_list'); ?></a></li>	
<?php endif; ?>
	
<?php if ($this->_aVars['aEvent']['view_id'] == 0 && Phpfox ::getUserParam('event.can_feature_events')): ?>
		<li id="js_feature_<?php echo $this->_aVars['aEvent']['event_id']; ?>"<?php if ($this->_aVars['aEvent']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" title="<?php echo Phpfox::getPhrase('event.feature_this_event'); ?>" onclick="$(this).parent().hide(); $('#js_unfeature_<?php echo $this->_aVars['aEvent']['event_id']; ?>').show(); $(this).parents('.js_event_parent:first').addClass('row_featured').find('.js_featured_event').show(); $.ajaxCall('event.feature', 'event_id=<?php echo $this->_aVars['aEvent']['event_id']; ?>&amp;type=1'); return false;"><?php echo Phpfox::getPhrase('event.feature'); ?></a></li>				
		<li id="js_unfeature_<?php echo $this->_aVars['aEvent']['event_id']; ?>"<?php if (! $this->_aVars['aEvent']['is_featured']): ?> style="display:none;"<?php endif; ?>><a href="#" title="<?php echo Phpfox::getPhrase('event.un_feature_this_event'); ?>" onclick="$(this).parent().hide(); $('#js_feature_<?php echo $this->_aVars['aEvent']['event_id']; ?>').show(); $(this).parents('.js_event_parent:first').removeClass('row_featured').find('.js_featured_event').hide(); $.ajaxCall('event.feature', 'event_id=<?php echo $this->_aVars['aEvent']['event_id']; ?>&amp;type=0'); return false;"><?php echo Phpfox::getPhrase('event.unfeature'); ?></a></li>				
<?php endif; ?>
	
<?php if (Phpfox ::getUserParam('event.can_sponsor_event')): ?>
		<li id="js_event_sponsor_<?php echo $this->_aVars['aEvent']['event_id']; ?>" <?php if ($this->_aVars['aEvent']['is_sponsor']): ?>style="display:none;"<?php endif; ?>><a href="#" onclick="$.ajaxCall('event.sponsor', 'event_id=<?php echo $this->_aVars['aEvent']['event_id']; ?>&type=1', 'GET'); return false;"><?php echo Phpfox::getPhrase('event.sponsor_this_event'); ?></a></li>
		<li id="js_event_unsponsor_<?php echo $this->_aVars['aEvent']['event_id']; ?>" <?php if (! $this->_aVars['aEvent']['is_sponsor']): ?>style="display:none;"<?php endif; ?>><a href="#" onclick="$.ajaxCall('event.sponsor', 'event_id=<?php echo $this->_aVars['aEvent']['event_id']; ?>&type=0', 'GET'); return false;"><?php echo Phpfox::getPhrase('event.unsponsor_this_event'); ?></a></li>				
<?php elseif (Phpfox ::getUserParam('event.can_purchase_sponsor') && ! defined ( 'PHPFOX_IS_GROUP_VIEW' ) && $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && $this->_aVars['aEvent']['is_sponsor'] != 1): ?>
		<li> 
			<a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aEvent']['event_id'], $this->_aVars['aEvent']['title'], false, null, (array) array (
  'section' => 'event',
)); ?>"> 
<?php echo Phpfox::getPhrase('event.sponsor_this_event'); ?>
			</a>
		</li>
<?php endif; ?>
	
<?php if (( ( $this->_aVars['aEvent']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('event.can_delete_own_event')) || Phpfox ::getUserParam('event.can_delete_other_event')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
		<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('event', array('delete' => $this->_aVars['aEvent']['event_id'])); ?>" class="sJsConfirm"><?php echo Phpfox::getPhrase('event.delete_event'); ?></a></li>
<?php endif; ?>
									</ul>			
								</div>
								<div class="row_edit_bar">				
										<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('event.actions'); ?></span></a>							
								</div>
							</div>		
<?php endif; ?>
<?php if (Phpfox ::getUserParam('event.can_approve_events') || Phpfox ::getUserParam('event.can_delete_other_event')): ?><a href="#<?php echo $this->_aVars['aEvent']['event_id']; ?>" class="moderate_link" rel="event"><?php echo Phpfox::getPhrase('event.moderate'); ?></a><?php endif; ?>
						</div>
						<div class="row_title_info">		
							<a href="<?php echo $this->_aVars['aEvent']['url']; ?>" class="link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['title']), 25); ?></a>
							<div class="extra_info">
								<ul class="extra_info_middot"><li><?php echo $this->_aVars['aEvent']['start_time_phrase']; ?> <?php echo Phpfox::getPhrase('event.at'); ?> <?php echo $this->_aVars['aEvent']['start_time_phrase_stamp']; ?></li><li><span>&middot;</span></li><li><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aEvent']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aEvent']['user_name'], ((empty($this->_aVars['aEvent']['user_name']) && isset($this->_aVars['aEvent']['profile_page_id'])) ? $this->_aVars['aEvent']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aEvent']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?></li></ul>
							</div>
							
<?php if (Phpfox ::isMobile()): ?>
							<a href="<?php echo $this->_aVars['aEvent']['url']; ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aEvent']['server_id'],'title' => $this->_aVars['aEvent']['title'],'path' => 'event.url_image','file' => $this->_aVars['aEvent']['image_path'],'suffix' => '_120','max_width' => '120','max_height' => '120')); ?></a>
<?php endif; ?>
	
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aEvent']['aFeed'])); ?>
							
						</div>			
						
					</div>	
<?php if (! Phpfox ::isMobile()): ?>
				</div>
<?php endif; ?>
			</div>
<?php endforeach; endif; ?>
		</div>
	</div>
</div>
<?php endforeach; endif; ?>

<?php if (Phpfox ::getUserParam('event.can_approve_events') || Phpfox ::getUserParam('event.can_delete_other_event')):  Phpfox::getBlock('core.moderation');  endif; ?>

<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  endif; ?>
