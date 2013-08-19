<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 23, 2013, 7:00 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Poll
 * @version 		$Id: index.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

 if (! count ( $this->_aVars['aPolls'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('poll.no_polls_found'); ?>
</div>
<?php else:  if (count((array)$this->_aVars['aPolls'])):  $this->_aPhpfoxVars['iteration']['polls'] = 0;  foreach ((array) $this->_aVars['aPolls'] as $this->_aVars['iKey'] => $this->_aVars['aPoll']):  $this->_aPhpfoxVars['iteration']['polls']++; ?>

	<?php /* Cached: June 23, 2013, 7:00 am */  
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
				<?php /* Cached: June 23, 2013, 7:00 am */  
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
							<?php /* Cached: June 23, 2013, 7:00 am */  
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
<?php /* Cached: June 23, 2013, 7:00 am */  if (( ( isset ( $this->_aVars['aPoll']['voted'] ) ) || ( ! Phpfox ::getUserParam('poll.can_vote_in_own_poll') && ( $this->_aVars['aPoll']['user_id'] == Phpfox ::getUserId())) || ( isset ( $this->_aVars['bDesign'] ) && $this->_aVars['bDesign'] ) )): ?>
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
<?php endif;  endforeach; endif;  if (Phpfox ::getUserParam('poll.poll_can_moderate_polls')):  Phpfox::getBlock('core.moderation');  endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  endif; ?>
