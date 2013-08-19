<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 30, 2013, 12:53 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: $
 */
 
 

 if ($this->_aVars['sPermaView'] === null): ?>

<?php if ($this->_aVars['aThread']['is_closed']): ?>
<div class="sub_menu_bar_main"><a href="#" onclick="return false;"><?php echo Phpfox::getPhrase('forum.closed'); ?></a></div>
<?php else:  if (( Phpfox ::getUserParam('forum.can_reply_to_own_thread') && $this->_aVars['aThread']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('forum.can_reply_on_other_threads') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aThread']['forum_id'] . '' , 'can_reply' )): ?>
<div class="sub_menu_bar_main"><a href="#" onclick="$Core.box('forum.reply', 800, 'id=<?php echo $this->_aVars['aThread']['thread_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('forum.new_reply'); ?></a></div>
<?php endif;  endif; ?>

<?php if ($this->_aVars['aThread']['view_id']): ?>
<div class="message">
<?php echo Phpfox::getPhrase('forum.thread_is_pending_approval'); ?>
</div>
<?php endif;  if (! $this->_aVars['aThread']['is_announcement']): ?>
<div class="forum_header_menu">
	<ul class="sub_menu_bar">	
<?php if (Phpfox ::isModule('share')): ?>
<?php Phpfox::getBlock('share.link', array('type' => 'forum','url' => $this->_aVars['sCurrentThreadLink'],'title' => $this->_aVars['aThread']['title'],'display' => 'menu')); ?>
<?php endif; ?>
<?php if (Phpfox ::isUser()): ?>
		<li class="sub_menu_bar_li">
			<a href="#" class="sJsDropMenu drop_down_link"><?php echo Phpfox::getPhrase('forum.thread_tools'); ?></a>
			<div class="link_menu dropContent">
				<ul>
<?php if ($this->_aVars['aThread']['view_id'] && ( Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aThread']['forum_id'] . '' , 'approve_thread' ) )): ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current', array('approve' => 'true')); ?>"><?php echo Phpfox::getPhrase('forum.approve_thread'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['bCanEditThread']): ?>
					<li><a href="<?php if ($this->_aVars['aCallback'] === null):  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('edit' => $this->_aVars['aThread']['thread_id']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('module' => 'pages','item' => $this->_aVars['aCallback']['group_id'],'edit' => $this->_aVars['aThread']['thread_id']));  endif; ?>"><?php echo Phpfox::getPhrase('forum.edit_thread'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['aCallback'] === null): ?>
<?php if (Phpfox ::getUserParam('forum.can_move_forum_thread') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aThread']['forum_id'] . '' , 'move_thread' )): ?>
					<li><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('forum.move_thread', array('phpfox_squote' => true)); ?>', $.ajaxBox('forum.move', 'height=200&amp;width=550&amp;thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>')); return false;"><?php echo Phpfox::getPhrase('forum.move_thread'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('forum.can_copy_forum_thread') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aThread']['forum_id'] . '' , 'copy_thread' )): ?>
					<li><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('forum.copy_thread', array('phpfox_squote' => true)); ?>', $.ajaxBox('forum.copy', 'height=200&amp;width=550&amp;thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>')); return false;"><?php echo Phpfox::getPhrase('forum.copy_thread'); ?></a></li>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_aVars['bCanDeleteThread']): ?>
					<li><a href="#" onclick="return $Core.forum.deleteThread('<?php echo $this->_aVars['aThread']['thread_id']; ?>');"><?php echo Phpfox::getPhrase('forum.delete_thread'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['bCanStickThread']): ?>
<?php if ($this->_aVars['aThread']['order_id'] == 1): ?>
					<li id="js_stick_thread"><a href="#" onclick="return $Core.forum.stickThread('<?php echo $this->_aVars['aThread']['thread_id']; ?>', 0);"><?php echo Phpfox::getPhrase('forum.unstick_thread'); ?></a></li>
<?php else: ?>
					<li id="js_stick_thread"><a href="#" onclick="return $Core.forum.stickThread('<?php echo $this->_aVars['aThread']['thread_id']; ?>', 1);"><?php echo Phpfox::getPhrase('forum.stick_thread'); ?></a></li>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_aVars['bCanCloseThread']): ?>
<?php if ($this->_aVars['aThread']['is_closed']): ?>
					<li id="js_close_thread"><a href="#" onclick="return $Core.forum.closeThread('<?php echo $this->_aVars['aThread']['thread_id']; ?>', 0);"><?php echo Phpfox::getPhrase('forum.open_thread'); ?></a></li>
<?php else: ?>
					<li id="js_close_thread"><a href="#" onclick="return $Core.forum.closeThread('<?php echo $this->_aVars['aThread']['thread_id']; ?>', 1);"><?php echo Phpfox::getPhrase('forum.close_thread'); ?></a></li>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_aVars['bCanMergeThread']): ?>
					<li><a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('forum.merge_threads', array('phpfox_squote' => true)); ?>', $.ajaxBox('forum.merge', 'height=200&amp;width=550&amp;thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>')); return false;"><?php echo Phpfox::getPhrase('forum.merge_threads'); ?></a></li>
<?php endif; ?>
					<li id="js_subscribe"<?php if ($this->_aVars['aThread']['is_subscribed']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$(this).parent().hide(); $('#js_unsubscribe').show(); $.ajaxCall('forum.subscribe', 'thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>&amp;subscribe=1'); return false;"><?php echo Phpfox::getPhrase('forum.subscribe'); ?></a></li>
					<li id="js_unsubscribe"<?php if (! $this->_aVars['aThread']['is_subscribed']): ?> style="display:none;"<?php endif; ?>><a href="#" onclick="$(this).parent().hide(); $('#js_subscribe').show(); $.ajaxCall('forum.subscribe', 'thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>&amp;subscribe=0'); return false;"><?php echo Phpfox::getPhrase('forum.unsubscribe'); ?></a></li>

<?php if ($this->_aVars['bCanPurchaseSponsor']): ?>
<?php if (Phpfox ::getUserParam('forum.can_sponsor_thread')): ?>
					<li>
					    <span id="js_sponsor_thread_<?php echo $this->_aVars['aThread']['thread_id']; ?>" <?php if ($this->_aVars['aThread']['order_id'] == 2): ?>style="display:none;"<?php endif; ?>>
						<a href="#" onclick="$.ajaxCall('forum.sponsor','thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>&type=2');return false;">
<?php echo Phpfox::getPhrase('forum.sponsor'); ?>
						</a>
					    </span>
					    <span id="js_unsponsor_thread_<?php echo $this->_aVars['aThread']['thread_id']; ?>" <?php if ($this->_aVars['aThread']['order_id'] != 2): ?>style="display:none;"<?php endif; ?>>
						  <a href="#" onclick="$.ajaxCall('forum.sponsor','thread_id=<?php echo $this->_aVars['aThread']['thread_id']; ?>&type=0');return false;">
<?php echo Phpfox::getPhrase('forum.unsponsor'); ?>
						</a>
					    </span>
					</li>
				    
<?php elseif (Phpfox ::getUserParam('forum.can_purchase_sponsor')): ?>
					<li>
					    <a href="<?php echo Phpfox::permalink('ad.sponsor', $this->_aVars['aThread']['thread_id'], null, false, null, (array) array (
)); ?>section_forum-thread/"><?php echo Phpfox::getPhrase('forum.sponsor'); ?></a>
					</li>
<?php endif; ?>
<?php endif; ?>
				</ul>
			</div>
		</li>
<?php endif; ?>
<?php if (Phpfox ::getParam('forum.enable_rss_on_threads') && Phpfox ::isModule('rss')): ?>
		<li class="sub_menu_bar_li">
			<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.rss', array('thread' => $this->_aVars['aThread']['thread_id'])); ?>" title="<?php echo Phpfox::getPhrase('forum.subscribe_to_this_thread'); ?>" class="no_ajax_link">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'rss/tiny.png','class' => 'v_middle')); ?>
			</a>
		</li>
<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>

<?php if (! empty ( $this->_aVars['aPoll']['question'] )): ?>
<div class="table_info">
<?php echo Phpfox::getPhrase('forum.poll'); ?>: <?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPoll']['question']); ?>
</div>
<div class="forum_poll_content">
	<?php /* Cached: May 30, 2013, 12:53 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Poll
 * @version 		$Id: entry.html.php 5042 2012-11-26 08:19:29Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['bIsViewingPoll'] )): ?>
    <div class="item_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aPoll']['time_stamp']); ?> <?php echo Phpfox::getPhrase('poll.by'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPoll']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPoll']['user_name'], ((empty($this->_aVars['aPoll']['user_name']) && isset($this->_aVars['aPoll']['profile_page_id'])) ? $this->_aVars['aPoll']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPoll']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
    </div>
    
<?php if (isset ( $this->_aVars['bIsViewingPoll'] ) && ( isset ( $this->_aVars['aPoll']['view_id'] ) && ! isset ( $this->_aVars['bDesign'] ) && $this->_aVars['aPoll']['view_id'] == 1 )): ?>
	<div class="message js_moderation_off" id="js_approve_message">
<?php echo Phpfox::getPhrase('poll.this_poll_is_being_moderated_and_no_votes_can_be_added_until_it_has_been_approved'); ?>
	</div>	
<?php endif; ?>

<?php if (( isset ( $this->_aVars['aPoll']['view_id'] ) && $this->_aVars['aPoll']['view_id'] == 1 && Phpfox ::getUserParam('poll.poll_can_moderate_polls')) || $this->_aVars['aPoll']['bCanEdit'] || ( ! isset ( $this->_aVars['bIsCustomPoll'] ) && ( isset ( $this->_aVars['aPoll']['user_id'] ) && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('poll.poll_can_delete_own_polls')))): ?>
	<div class="item_bar">
		<div class="item_bar_action_holder">
<?php if (isset ( $this->_aVars['aPoll']['view_id'] ) && $this->_aVars['aPoll']['view_id'] == 1 && Phpfox ::getUserParam('poll.poll_can_moderate_polls')): ?>
				<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>			
				<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('poll.moderatePoll','iResult=0&amp;iPoll=<?php echo $this->_aVars['aPoll']['poll_id']; ?>&amp;inline=true'); return false;"><?php echo Phpfox::getPhrase('poll.approve'); ?></a>
<?php endif; ?>
			<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('poll.actions'); ?></span></a>		
			<ul>
				<?php /* Cached: May 30, 2013, 12:53 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: link.html.php 2501 2011-04-04 20:13:13Z Raymond_Benc $
 */
 
 

?>		
<?php if (( $this->_aVars['aPoll']['bCanEdit'] )): ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) || $this->_aVars['bDesign'] == false): ?>
							<li>
								<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('poll.add', array('id' => $this->_aVars['aPoll']['poll_id'])); ?>">
<?php echo Phpfox::getPhrase('poll.edit'); ?>
								</a>	
							</li>
<?php endif; ?>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['bIsCustomPoll'] )): ?>
<?php if (( ( Phpfox ::getUserParam('poll.poll_can_delete_own_polls') && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('poll.poll_can_delete_others_polls'))): ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) || $this->_aVars['bDesign'] == false): ?>
							<li class="item_delete">
								<a <?php if (isset ( $this->_aVars['bIsViewingPoll'] )): ?>href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('poll', array('delete' => $this->_aVars['aPoll']['poll_id'])); ?>" class="sJsConfirm"<?php else: ?>href="#" onclick="deletePoll(<?php echo $this->_aVars['aPoll']['poll_id']; ?>); return false;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('poll.delete'); ?>
								</a>
							</li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
			</ul>			
		</div>
	</div>
<?php endif;  endif; ?>

<?php if (isset ( $this->_aVars['aPoll'] )): ?>
<div id="poll_holder_<?php echo $this->_aVars['aPoll']['poll_id']; ?>"<?php if (! isset ( $this->_aVars['bIsViewingPoll'] )): ?> class="<?php if (isset ( $this->_aVars['aPoll']['view_id'] ) && ( ! isset ( $this->_aVars['bDesign'] ) && $this->_aVars['aPoll']['view_id'] == 1 && ( Phpfox ::getUserParam('poll.poll_can_moderate_polls') || ( $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId())))): ?> <?php endif;  if (isset ( $this->_aVars['bIsViewingPoll'] ) || ( isset ( $this->_aVars['bDesign'] ) && $this->_aVars['bDesign'] )): ?>row1 row_first<?php else:  if (isset ( $this->_aPhpfoxVars['iteration']['polls'] ) && is_int ( $this->_aPhpfoxVars['iteration']['polls'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if (isset ( $this->_aPhpfoxVars['iteration']['polls'] ) && $this->_aPhpfoxVars['iteration']['polls'] == 1): ?> row_first<?php endif;  endif; ?>"<?php endif; ?>>
	
	<div class="vote_holder_<?php echo $this->_aVars['aPoll']['poll_id']; ?>">		
		
<?php if (! isset ( $this->_aVars['bIsViewingPoll'] )): ?>
		<div class="row_title">
			
			<div class="row_title_image">	
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aPoll'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) && ( Phpfox ::getUserParam('poll.poll_can_moderate_polls') || $this->_aVars['aPoll']['bCanEdit'] || ( isset ( $this->_aVars['aPoll']['user_id'] ) && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('poll.poll_can_delete_own_polls')))): ?>
				<div class="row_edit_bar_parent">
					<div class="row_edit_bar_holder">
						<ul>
							<?php /* Cached: May 30, 2013, 12:53 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: link.html.php 2501 2011-04-04 20:13:13Z Raymond_Benc $
 */
 
 

?>		
<?php if (( $this->_aVars['aPoll']['bCanEdit'] )): ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) || $this->_aVars['bDesign'] == false): ?>
							<li>
								<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('poll.add', array('id' => $this->_aVars['aPoll']['poll_id'])); ?>">
<?php echo Phpfox::getPhrase('poll.edit'); ?>
								</a>	
							</li>
<?php endif; ?>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['bIsCustomPoll'] )): ?>
<?php if (( ( Phpfox ::getUserParam('poll.poll_can_delete_own_polls') && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('poll.poll_can_delete_others_polls'))): ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) || $this->_aVars['bDesign'] == false): ?>
							<li class="item_delete">
								<a <?php if (isset ( $this->_aVars['bIsViewingPoll'] )): ?>href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('poll', array('delete' => $this->_aVars['aPoll']['poll_id'])); ?>" class="sJsConfirm"<?php else: ?>href="#" onclick="deletePoll(<?php echo $this->_aVars['aPoll']['poll_id']; ?>); return false;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('poll.delete'); ?>
								</a>
							</li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
						</ul>			
					</div>
					<div class="row_edit_bar">				
						<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('poll.actions'); ?></span></a>							
					</div>
				</div>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['bDesign'] ) && Phpfox ::getUserParam('poll.poll_can_moderate_polls')): ?>
				<a href="#<?php echo $this->_aVars['aPoll']['poll_id']; ?>" class="moderate_link" rel="poll"><?php echo Phpfox::getPhrase('poll.moderate'); ?></a>							
<?php endif; ?>
			</div>			
			
			<div class="row_title_info">
				<span id="poll_view_<?php echo $this->_aVars['aPoll']['poll_id']; ?>"><a href="<?php echo Phpfox::permalink('poll', $this->_aVars['aPoll']['poll_id'], $this->_aVars['aPoll']['question'], false, null, (array) array (
)); ?>" id="poll_inner_title_<?php echo $this->_aVars['aPoll']['poll_id']; ?>" class="link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPoll']['question']), 55, '...'), 40); ?></a></span>		
				<div class="extra_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aPoll']['time_stamp']); ?> <?php echo Phpfox::getPhrase('poll.by'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPoll']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPoll']['user_name'], ((empty($this->_aVars['aPoll']['user_name']) && isset($this->_aVars['aPoll']['profile_page_id'])) ? $this->_aVars['aPoll']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPoll']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
				</div>			
					
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aPoll']['image_path'] ) && $this->_aVars['aPoll']['image_path'] != ''): ?>
			<div class="item_image" style="width:<?php echo Phpfox::getParam('poll.poll_max_image_pic_size'); ?>px;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('thickbox' => true,'server_id' => $this->_aVars['aPoll']['server_id'],'title' => $this->_aVars['aPoll']['question'],'path' => 'poll.url_image','file' => $this->_aVars['aPoll']['image_path'],'suffix' => $this->_aVars['sSuffix'],'max_width' => 'poll.poll_max_image_pic_size','max_height' => 'poll.poll_max_image_pic_size')); ?>
			</div>
			<div class="item_image_content" style="margin-left:<?php echo Phpfox::getParam('poll.poll_max_image_pic_size'); ?>px;">
<?php endif; ?>
			
			<div id="js_poll_results_<?php echo $this->_aVars['aPoll']['poll_id']; ?>">			
<?php /* Cached: May 30, 2013, 12:53 pm */  if (( ( isset ( $this->_aVars['aPoll']['voted'] ) ) || ( ! Phpfox ::getUserParam('poll.can_vote_in_own_poll') && ( $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId())) || ( isset ( $this->_aVars['bDesign'] ) && $this->_aVars['bDesign'] ) )): ?>
<div class="votes">					
<?php if (count((array)$this->_aVars['aPoll']['answer'])):  foreach ((array) $this->_aVars['aPoll']['answer'] as $this->_aVars['aAnswer']): ?>
	<div class="answers_container<?php if (Phpfox ::getUserParam('poll.highlight_answer_voted_by_viewer') && isset ( $this->_aVars['aPoll']['voted'] ) && $this->_aVars['aPoll']['answer_id'] == $this->_aVars['aAnswer']['answer_id']): ?> user_answered_this<?php endif; ?>">
		<div><?php echo $this->_aVars['aAnswer']['answer']; ?></div>	
<?php if (( ( isset ( $this->_aVars['aPoll']['user_voted_this_poll'] ) && ( ( $this->_aVars['aPoll']['user_voted_this_poll'] == false && Phpfox ::getUserParam('poll.view_poll_results_before_vote')) || ( $this->_aVars['aPoll']['user_voted_this_poll'] == true && Phpfox ::getUserParam('poll.view_poll_results_after_vote')))) || ( ! isset ( $this->_aVars['aPoll']['user_voted_this_poll'] ) ) ) || ( ( isset ( $this->_aVars['bDesign'] ) && $this->_aVars['bDesign'] ) )): ?>
<?php if (! isset ( $this->_aVars['bDesign'] )): ?>
		<div class="extra_info">
<?php if (isset ( $this->_aVars['aAnswer']['vote_percentage'] )): ?>
				&nbsp;<?php echo $this->_aVars['aAnswer']['vote_percentage']; ?>% (<?php echo Phpfox::getPhrase('poll.total_votes_votes', array('total_votes' => $this->_aVars['aAnswer']['total_votes'])); ?>)
<?php else: ?>
<?php echo Phpfox::getPhrase('poll.votes_0'); ?>
<?php endif; ?>
		</div>
<?php endif; ?>
		<div class="poll_answer_container js_sample_outer" style="border:1px solid #<?php if (isset ( $this->_aVars['aPoll']['border'] ) && ( $this->_aVars['aPoll']['border'] != '' )):  echo $this->_aVars['aPoll']['border'];  else: ?>000<?php endif; ?>; background:<?php if (isset ( $this->_aVars['aPoll']['background'] ) && ( $this->_aVars['aPoll']['background'] != '' )): ?>#<?php echo $this->_aVars['aPoll']['background'];  else: ?>b70000<?php endif; ?>;">
			<div class="poll_answer_percentage js_sample_percent percentage" style="background:<?php if (isset ( $this->_aVars['aPoll']['percentage'] ) && ( $this->_aVars['aPoll']['percentage'] != '' )): ?>#<?php echo $this->_aVars['aPoll']['percentage'];  else: ?>#93D9FF<?php endif; ?>; <?php if (isset ( $this->_aVars['bDesign'] ) && $this->_aVars['bDesign']): ?>width:40%;<?php else:  if (isset ( $this->_aVars['aAnswer']['vote_percentage'] )): ?>width:<?php echo $this->_aVars['aAnswer']['vote_percentage'];  elseif (! Phpfox ::getUserParam('poll.can_vote_in_own_poll')): ?>width:0<?php endif; ?>%;<?php endif; ?>">&nbsp;</div>
		</div>
<?php endif; ?>
	</div>
<?php endforeach; else: ?>
<?php echo Phpfox::getPhrase('poll.no_answers_to_show'); ?>
<?php endif; ?>
	
<?php if (isset ( $this->_aVars['aPoll']['answer'] ) && count ( $this->_aVars['aPoll']['answer'] ) && ! isset ( $this->_aVars['bDesign'] ) && $this->_aVars['aPoll']['total_votes'] > 0 && ( ( Phpfox ::getUserParam('poll.can_view_user_poll_results_own_poll') && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('poll.can_view_user_poll_results_other_poll'))): ?>
	<div class="poll_result_link">
		<a href="#" onclick="$Core.box('poll.pageVotes', 400, 'poll_id=<?php echo $this->_aVars['aPoll']['poll_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('poll.view_results'); ?></a>
	</div>
<?php endif; ?>
</div>
<?php else: ?>
<div id="vote_<?php echo $this->_aVars['aPoll']['poll_id']; ?>">				
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" id="js_poll_form_<?php echo $this->_aVars['aPoll']['poll_id']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div><input type="hidden" name="val[poll_id]" value="<?php echo $this->_aVars['aPoll']['poll_id']; ?>" /></div>
<?php if (isset ( $this->_aVars['aPoll']['answer'] )): ?>
<?php if (count((array)$this->_aVars['aPoll']['answer'])):  foreach ((array) $this->_aVars['aPoll']['answer'] as $this->_aVars['answer']): ?>
<?php if (! empty ( $this->_aVars['answer']['answer'] )): ?>
			<div class="p_2">
				<label onclick="$('#js_submit_vote<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>').show(); $('.js_poll_answer<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>').attr('checked', false); $(this).find('.js_poll_answer<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>').attr('checked', true);">
					<input class="checkbox js_poll_answer<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>" type="radio" name="val[answer]" value="<?php echo $this->_aVars['answer']['answer_id']; ?>" style="vertical-align:middle;" /> 
					<span title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['answer']['answer']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['answer']['answer']), 50), 150, '...'); ?></span>
				</label>
			</div>
<?php endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
		<div class="p_4" id="js_submit_vote<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>" style="display:none;">
<?php if (isset ( $this->_aVars['aPoll']['view_id'] ) && ! isset ( $this->_aVars['bDesign'] ) && $this->_aVars['aPoll']['view_id'] == 1): ?>
			<div class="extra_info js_moderation_off">
<?php echo Phpfox::getPhrase('poll.cannot_cast_a_vote_when_a_poll_is_pending_approval'); ?>
			</div>
<?php endif; ?>
			<div <?php if (isset ( $this->_aVars['aPoll']['view_id'] ) && ! isset ( $this->_aVars['bDesign'] ) && $this->_aVars['aPoll']['view_id'] == 1): ?>style="display:none;" class="js_moderation_on"<?php endif; ?>>
				<input type="button" value="<?php echo Phpfox::getPhrase('poll.submit_your_vote'); ?>" class="button" onclick="$(this).parent().hide(); $(this).parents('.p_4:first').find('.js_poll_image_ajax:first').show(); $('#js_poll_form_<?php echo $this->_aVars['aPoll']['poll_id']; ?>').ajaxCall('poll.addVote');return false;" />&nbsp;<input type="button" class="button button_off" onclick="$('#js_poll_form_<?php echo $this->_aVars['aPoll']['poll_id']; ?>')[0].reset(); $('#js_submit_vote<?php if (isset ( $this->_aVars['iKey'] )): ?>_<?php echo $this->_aVars['iKey'];  endif; ?>').hide();" value="<?php echo Phpfox::getPhrase('poll.cancel_uppercase'); ?>" />
			</div>			
			<div class="js_poll_image_ajax" style="display:none;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'v_middle')); ?>
			</div>
		</div>
	
</form>

</div>
<?php endif; ?>
			</div>	

<?php if (! isset ( $this->_aVars['bDesign'] ) && isset ( $this->_aVars['bIsViewingPoll'] ) && $this->_aVars['aPoll']['total_votes'] > 0 && ( ( Phpfox ::getUserParam('poll.can_view_user_poll_results_own_poll') && $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('poll.can_view_user_poll_results_other_poll'))): ?>
<?php if (isset ( $this->_aVars['aPoll']['user_voted_this_poll'] ) && ( $this->_aVars['aPoll']['user_voted_this_poll'] == false && Phpfox ::getUserParam('poll.view_poll_results_before_vote')) || ( $this->_aVars['aPoll']['user_voted_this_poll'] == true && Phpfox ::getUserParam('poll.view_poll_results_after_vote'))): ?>
			<div style="max-width:500px;">
<?php if (! isset ( $this->_aVars['bIsCustomPoll'] )): ?>
				<div id="votes"><a name="votes"></a></div>
				<h3><?php echo Phpfox::getPhrase('poll.members_votes_total_votes', array('total_votes' => $this->_aVars['aPoll']['total_votes'])); ?></h3>			
<?php if (! Phpfox ::getUserParam('poll.can_view_hidden_poll_votes') && $this->_aVars['aPoll']['hide_vote'] == '1' && Phpfox ::getUserId() != $this->_aVars['aPoll']['user_id']): ?>
				<div class="message">
<?php echo Phpfox::getPhrase('poll.votes_are_hidden_for_this_poll'); ?>
				</div>
<?php else: ?>
				<div id="js_votes">
<?php Phpfox::getBlock("poll.votes", array('page' => '0')); ?>
				</div>
			</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
	
<?php if (isset ( $this->_aVars['aPoll']['image_path'] ) && $this->_aVars['aPoll']['image_path'] != ''): ?>
		</div>
	<div class="clear"></div>
<?php endif; ?>
	
<?php if (! isset ( $this->_aVars['bIsViewingPoll'] ) && isset ( $this->_aVars['aPoll']['aFeed'] )): ?>
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aPoll']['aFeed'])); ?>
<?php endif; ?>
	
<?php if (! isset ( $this->_aVars['bIsViewingPoll'] )): ?>
			</div>	
			<div class="clear"></div>
		</div>
<?php endif; ?>
	</div>	
	
</div>	
<?php endif; ?>
</div>
<?php endif; ?>

<?php endif;  endif; ?>

<?php if ($this->_aVars['sPermaView'] !== null): ?>
<div class="table_info">
	<div class="go_left">
<?php echo Phpfox::getPhrase('forum.viewing_single_post'); ?>
	</div>
	<div class="t_right" style="padding-right:5px;">
<?php echo Phpfox::getPhrase('forum.thread'); ?>: <a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aThread']['title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aThread']['title']), 50, '...'); ?></a>
	</div>
	<div class="clear"></div>
</div>
<?php endif; ?>

<div class="forum_thread_view_holder">
	<div id="js_thread_start"></div>
<?php if (count((array)$this->_aVars['aThread']['posts'])):  $this->_aPhpfoxVars['iteration']['posts'] = 0;  foreach ((array) $this->_aVars['aThread']['posts'] as $this->_aVars['aPost']):  $this->_aPhpfoxVars['iteration']['posts']++; ?>

<?php (($sPlugin = Phpfox_Plugin::get('forum.template_controller_post_1')) ? eval($sPlugin) : false); ?>
		<?php /* Cached: May 30, 2013, 12:53 pm */ 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: $
 */
 
 

 if (! isset ( $this->_aVars['bIsPostUpdateText'] )): ?>
<div id="post<?php echo $this->_aVars['aPost']['post_id']; ?>">
<?php endif; ?>
	<div class="js_post_count"><a name="post<?php echo $this->_aVars['aPost']['post_id']; ?>"></a></div>	
	<div class="forum_outer">
		<div class="forum_user_info_holder">
<?php if (! Phpfox ::isMobile()): ?>
			<div class="forum_user_info_holder_inner">
				<div class="forum_user_info_holder_inner_image"></div>
				<div class="forum_user_info">
					<div class="forum_thread_photo">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aPost'],'suffix' => '_100_square','max_width' => 100,'max_height' => 100)); ?>
					</div>
					<div class="forum_thread_user">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPost']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPost']['user_name'], ((empty($this->_aVars['aPost']['user_name']) && isset($this->_aVars['aPost']['profile_page_id'])) ? $this->_aVars['aPost']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPost']['full_name'], 13, '...') . '</a></span>'; ?>
					</div>
<?php if (! isset ( $this->_aVars['bIsSearch'] )): ?>
					<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.posts'); ?>: <span class="js_user_post_<?php echo $this->_aVars['aPost']['user_id']; ?>"><?php echo $this->_aVars['aPost']['total_post']; ?></span><br />
<?php (($sPlugin = Phpfox_Plugin::get('forum.template_block_post_1')) ? eval($sPlugin) : false); ?>
					</div>
<?php endif; ?>
				</div>
			</div>

<?php if (( Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getUserParam('forum.can_delete_other_posts'))): ?>
				<a href="#<?php echo $this->_aVars['aPost']['post_id']; ?>" class="moderate_link" rel="forumpost"><?php echo Phpfox::getPhrase('forum.moderate'); ?></a>
<?php endif; ?>
			
<?php endif; ?>
		</div>
		<div class="forum_main">		
<?php (($sPlugin = Phpfox_Plugin::get('forum.template_block_post_2')) ? eval($sPlugin) : false); ?>
<?php if (Phpfox ::isMobile()): ?>
			<div class="mobile_forum_thread_user">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPost']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPost']['user_name'], ((empty($this->_aVars['aPost']['user_name']) && isset($this->_aVars['aPost']['profile_page_id'])) ? $this->_aVars['aPost']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPost']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
			</div>			
<?php endif; ?>
<?php if (isset ( $this->_aVars['bIsSearch'] )): ?>
			<div class="forum_search_post">
				<ul class="extra_info_middot"><li><?php echo Phpfox::getPhrase('forum.posted_in'); ?> "<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aPost']['thread_id'], $this->_aVars['aPost']['thread_title'], false, null, (array) array (
)); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPost']['thread_title']); ?></a>"</li><li>&middot;</li><li><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aPost']['time_stamp']); ?></li></ul>
			</div>
<?php endif; ?>
			<div class="forum_content<?php if (( isset ( $this->_aVars['aPost']['view_id'] ) && $this->_aVars['aPost']['view_id'] && ! isset ( $this->_aVars['sView'] ) ) || ( isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] != 'pending-post' )): ?> row_moderate<?php endif; ?> item_view_content" id="js_post_edit_text_<?php echo $this->_aVars['aPost']['post_id']; ?>">
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aPost']['text']), 55); ?>
			</div>
<?php if (Phpfox ::getUserParam('core.can_view_update_info') && ! empty ( $this->_aVars['aPost']['update_user'] )): ?>
			<div class="extra_info">
<?php echo $this->_aVars['aPost']['last_update_on']; ?>
			</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPost']['attachments'] )): ?>
<?php Phpfox::getBlock('attachment.list', array('sType' => 'forum','attachments' => $this->_aVars['aPost']['attachments'])); ?>
<?php endif; ?>
			
<?php if (! empty ( $this->_aVars['aPost']['signature'] )): ?>
			<div class="forum_signature">
<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aPost']['signature']); ?>
			</div>
<?php endif; ?>
			
<?php if (isset ( $this->_aPhpfoxVars['iteration']['posts'] ) && $this->_aPhpfoxVars['iteration']['posts'] == 1): ?>
<?php if (Phpfox ::isModule('tag') && isset ( $this->_aVars['aThread']['tag_list'] )): ?>
<?php Phpfox::getBlock('tag.item', array('sType' => 'forum','sTags' => $this->_aVars['aThread']['tag_list'],'item_id' => $this->_aVars['aThread']['thread_id'],'iUserId' => $this->_aVars['aThread']['user_id'])); ?>
<?php endif; ?>
<?php endif; ?>
			
<?php if (isset ( $this->_aVars['aPost']['aFeed'] )): ?>
			<div class="forum_time_stamp">
<?php if (Phpfox ::isModule('feed')): ?>
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aPost']['aFeed'])); ?>
<?php else: ?>
					<div class="js_feed_comment_border">
						<ul>
<?php if (! isset ( $this->_aVars['aPost']['aFeed']['feed_mini'] )): ?>
<?php if (! empty ( $this->_aVars['aPost']['aFeed']['feed_icon'] )): ?>
									<li><img src="<?php echo $this->_aVars['aPost']['aFeed']['feed_icon']; ?>" alt="" /></li>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aPost']['aFeed']['time_stamp'] )): ?>
									<li class="feed_entry_time_stamp">				
										<a href="<?php echo $this->_aVars['aPost']['aFeed']['feed_link']; ?>" class="feed_permalink"><?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aPost']['aFeed']['time_stamp'], 'core.global_update_time'); ?></a><?php if (! empty ( $this->_aVars['aPost']['aFeed']['app_link'] )): ?> <?php echo Phpfox::getPhrase('forum.via'); ?> <?php echo $this->_aVars['aPost']['aFeed']['app_link'];  endif; ?>
									</li>
									
									<li><span> &middot;</span></li>									
<?php endif; ?>
							
<?php if ($this->_aVars['aPost']['aFeed']['privacy'] > 0 && $this->_aVars['aPost']['aFeed']['user_id'] == Phpfox ::getUserId()): ?>
									<li><div class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/privacy_icon.png','alt' => $this->_aVars['aPost']['aFeed']['privacy'])); ?><span class="js_hover_info">2 <?php echo Phpfox::getService('privacy')->getPhrase($this->_aVars['aPost']['aFeed']['privacy']); ?></span></div></li>	
									
<?php if (Phpfox ::isModule('like')): ?>
										<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
								
<?php if (Phpfox ::isModule('like') && isset ( $this->_aVars['aPost']['Feed']['like_type_id'] )): ?>
<?php if (isset ( $this->_aVars['aPost']['aFeed']['like_item_id'] )): ?>
<?php Phpfox::getBlock('like.link', array('like_type_id' => $this->_aVars['aPost']['aFeed']['like_type_id'],'like_item_id' => $this->_aVars['aPost']['aFeed']['like_item_id'],'like_is_liked' => $this->_aVars['aPost']['aFeed']['feed_is_liked'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('like.link', array('like_type_id' => $this->_aVars['aPost']['aFeed']['like_type_id'],'like_item_id' => $this->_aVars['aPost']['aFeed']['item_id'],'like_is_liked' => $this->_aVars['aPost']['aFeed']['feed_is_liked'])); ?>
<?php endif; ?>
								
								<li><span>&middot;</span></li>
								
<?php endif; ?>
							
<?php if (Phpfox ::isModule('comment') && ( isset ( $this->_aVars['aPost']['aFeed']['comment_type_id'] ) && $this->_aVars['aPost']['aFeed']['can_post_comment'] ) || ( ! isset ( $this->_aVars['aPost']['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aPost']['aFeed']['total_comment'] ) )): ?>
								<li>
									<a href="<?php echo $this->_aVars['aPost']['aFeed']['feed_link']; ?>add-comment/" class="<?php if (( isset ( $this->_aVars['sFeedType'] ) && $this->_aVars['sFeedType'] == 'mini' ) || ( ! isset ( $this->_aVars['aPost']['aFeed']['comment_type_id'] ) && isset ( $this->_aVars['aPost']['aFeed']['total_comment'] ) )):  else: ?>js_feed_entry_add_comment no_ajax_link<?php endif; ?>"><?php echo Phpfox::getPhrase('feed.comment'); ?></a>
								</li>				
<?php if (( Phpfox ::isModule('share') && ! isset ( $this->_aVars['aPost']['aFeed']['no_share'] ) ) || ( isset ( $this->_aVars['aPost']['aFeed']['report_module'] ) && isset ( $this->_aVars['aPost']['aFeed']['force_report'] ) )): ?>
									<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
<?php if (Phpfox ::isModule('share') && ! isset ( $this->_aVars['aPost']['aFeed']['no_share'] )): ?>
<?php Phpfox::getBlock('share.link', array('type' => 'feed','display' => 'menu','url' => $this->_aVars['aPost']['aFeed']['feed_link'],'title' => $this->_aVars['aPost']['aFeed']['feed_title'])); ?>
								
<?php if (Phpfox ::isModule('report')): ?>
									<li><span>&middot;</span></li>
<?php endif; ?>
<?php endif; ?>
														
<?php if (Phpfox ::isModule('report') && isset ( $this->_aVars['aPost']['aFeed']['report_module'] ) && isset ( $this->_aVars['aPost']['aFeed']['force_report'] )): ?>
								
								<li><a href="#?call=report.add&amp;height=100&amp;width=400&amp;type=<?php echo $this->_aVars['aPost']['aFeed']['report_module']; ?>&amp;id=<?php echo $this->_aVars['aPost']['aFeed']['item_id']; ?>" class="inlinePopup activity_feed_report" title="<?php echo $this->_aVars['aPost']['aFeed']['report_phrase']; ?>"><?php echo Phpfox::getPhrase('forum.report'); ?></a></li>				
<?php endif; ?>
										
						</ul>
						
<?php (($sPlugin = Phpfox_Plugin::get('core.template_block_comment_border_new')) ? eval($sPlugin) : false); ?>
						
					</div>
<?php endif; ?>
			</div>		
<?php endif; ?>
		</div>
	</div>
<?php if (! isset ( $this->_aVars['bIsPostUpdateText'] )): ?>
</div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('forum.template_controller_post_2')) ? eval($sPlugin) : false); ?>
<?php endforeach; endif; ?>
	<div id="js_post_new_thread"></div>
</div>

<?php if (( Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getUserParam('forum.can_delete_other_posts'))):  Phpfox::getBlock('core.moderation');  endif; ?>

<?php if ($this->_aVars['sPermaView'] === null):  if (! $this->_aVars['aThread']['is_announcement']):  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  if ($this->_aVars['aThread']['is_closed']): ?>
<div class="sub_menu_bar_main sub_menu_bar_main_bottom"><a href="#" onclick="return false;"><?php echo Phpfox::getPhrase('forum.closed'); ?></a></div>
<?php else:  if (( Phpfox ::getUserParam('forum.can_reply_to_own_thread') && $this->_aVars['aThread']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('forum.can_reply_on_other_threads') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aThread']['forum_id'] . '' , 'can_reply' )): ?>
<div class="sub_menu_bar_main sub_menu_bar_main_bottom"><a href="#" onclick="$Core.box('forum.reply', 800, 'id=<?php echo $this->_aVars['aThread']['thread_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('forum.new_reply'); ?></a></div>
<?php endif;  endif;  endif; ?>

<?php endif; ?>

<?php Phpfox::getBlock('forum.jump', array()); ?>
