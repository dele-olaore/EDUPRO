<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 20, 2013, 2:39 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Quiz
 * @version 		$Id: index.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aQuizzes'] )):  if (count((array)$this->_aVars['aQuizzes'])):  $this->_aPhpfoxVars['iteration']['quizzes'] = 0;  foreach ((array) $this->_aVars['aQuizzes'] as $this->_aVars['aQuiz']):  $this->_aPhpfoxVars['iteration']['quizzes']++; ?>

	<?php /* Cached: June 20, 2013, 2:39 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Quiz
 * @version 		$Id: entry.html.php 3771 2011-12-13 11:41:30Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['bIsViewingQuiz'] )): ?>
    <div class="item_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aQuiz']['time_stamp']); ?> <?php echo Phpfox::getPhrase('quiz.by'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aQuiz']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aQuiz']['user_name'], ((empty($this->_aVars['aQuiz']['user_name']) && isset($this->_aVars['aQuiz']['profile_page_id'])) ? $this->_aVars['aQuiz']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aQuiz']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
    </div>
    
<?php if (( isset ( $this->_aVars['aQuiz']['view_id'] ) && $this->_aVars['aQuiz']['view_id'] == 1 )): ?>
	<div class="message js_moderation_off" id="js_approve_message">
<?php echo Phpfox::getPhrase('quiz.this_quiz_is_awaiting_moderation'); ?>
	</div>	
<?php endif; ?>

<?php if (Phpfox ::getUserParam('quiz.can_approve_quizzes') || Phpfox ::getUserParam('quiz.can_delete_others_quizzes') || ( ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('quiz.can_delete_own_quiz') ) || ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) || ( ( Phpfox ::getUserId() == $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_own_questions') || Phpfox ::getUserParam('quiz.can_edit_own_title'))) || ( Phpfox ::getUserId() != $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_others_questions') || Phpfox ::getUserParam('quiz.can_edit_others_title'))))): ?>
	<div class="item_bar">
		<div class="item_bar_action_holder">
<?php if (isset ( $this->_aVars['aQuiz']['view_id'] ) && $this->_aVars['aQuiz']['view_id'] == 1 && Phpfox ::getUserParam('quiz.can_approve_quizzes')): ?>
				<a href="#" class="item_bar_approve item_bar_approve_image" onclick="return false;" style="display:none;" id="js_item_bar_approve_image"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?></a>			
				<a href="#" class="item_bar_approve" onclick="$(this).hide(); $('#js_item_bar_approve_image').show(); $.ajaxCall('quiz.approve','iQuiz=<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>&amp;inline=true'); return false;"><?php echo Phpfox::getPhrase('quiz.approve'); ?></a>
<?php endif; ?>
			<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('quiz.actions'); ?></span></a>		
			<ul>
				<?php /* Cached: June 20, 2013, 2:39 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Poll
 * @version 		$Id: link.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

?>
<?php if (( ( Phpfox ::getUserId() == $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_own_questions') || Phpfox ::getUserParam('quiz.can_edit_own_title'))) || ( Phpfox ::getUserId() != $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_others_questions') || Phpfox ::getUserParam('quiz.can_edit_others_title'))))): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('quiz.add', array('id' => $this->_aVars['aQuiz']['quiz_id'])); ?>"><?php echo Phpfox::getPhrase('quiz.edit'); ?></a></li>
<?php endif; ?>
<?php if (( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId())): ?>
				<li><a href="<?php echo Phpfox::permalink('quiz', $this->_aVars['aQuiz']['quiz_id'], $this->_aVars['aQuiz']['title'], false, null, (array) array (
)); ?>results/""><?php echo Phpfox::getPhrase('quiz.view_results'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('quiz.can_delete_others_quizzes') || ( ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('quiz.can_delete_own_quiz') )): ?>
			<li class="item_delete"><a href="#" onclick="return $Core.quiz_moderate.deleteQuiz(<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>, '<?php if (isset ( $this->_aVars['bIsViewingQuiz'] ) && $this->_aVars['bIsViewingQuiz']): ?>viewing<?php else: ?>browsing<?php endif; ?>')"><?php echo Phpfox::getPhrase('quiz.delete'); ?></a></li>
<?php endif; ?>
			</ul>			
		</div>
	</div>
<?php endif;  endif; ?>
		
<div id="js_quiz_<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>" class="<?php if (isset ( $this->_aPhpfoxVars['iteration']['quizzes'] )): ?> <?php if (is_int ( $this->_aPhpfoxVars['iteration']['quizzes'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['quizzes'] == 1): ?> row_first<?php endif;  endif; ?>">

	<div id="js_message_<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>" style="display: none;"></div>
<?php if (! isset ( $this->_aVars['bIsViewingQuiz'] )): ?>
		<div class="row_title">
		
			<div class="row_title_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aQuiz'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php if (Phpfox ::getUserParam('quiz.can_approve_quizzes') || Phpfox ::getUserParam('quiz.can_delete_others_quizzes') || ( ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('quiz.can_delete_own_quiz') ) || ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) || ( ( Phpfox ::getUserId() == $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_own_questions') || Phpfox ::getUserParam('quiz.can_edit_own_title'))) || ( Phpfox ::getUserId() != $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_others_questions') || Phpfox ::getUserParam('quiz.can_edit_others_title'))))): ?>
				<div class="row_edit_bar_parent">
					<div class="row_edit_bar_holder">
						<ul>
							<?php /* Cached: June 20, 2013, 2:39 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Poll
 * @version 		$Id: link.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

?>
<?php if (( ( Phpfox ::getUserId() == $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_own_questions') || Phpfox ::getUserParam('quiz.can_edit_own_title'))) || ( Phpfox ::getUserId() != $this->_aVars['aQuiz']['user_id'] && ( Phpfox ::getUserParam('quiz.can_edit_others_questions') || Phpfox ::getUserParam('quiz.can_edit_others_title'))))): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('quiz.add', array('id' => $this->_aVars['aQuiz']['quiz_id'])); ?>"><?php echo Phpfox::getPhrase('quiz.edit'); ?></a></li>
<?php endif; ?>
<?php if (( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId())): ?>
				<li><a href="<?php echo Phpfox::permalink('quiz', $this->_aVars['aQuiz']['quiz_id'], $this->_aVars['aQuiz']['title'], false, null, (array) array (
)); ?>results/""><?php echo Phpfox::getPhrase('quiz.view_results'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('quiz.can_delete_others_quizzes') || ( ( $this->_aVars['aQuiz']['user_id'] == Phpfox ::getUserId()) && Phpfox ::getUserParam('quiz.can_delete_own_quiz') )): ?>
			<li class="item_delete"><a href="#" onclick="return $Core.quiz_moderate.deleteQuiz(<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>, '<?php if (isset ( $this->_aVars['bIsViewingQuiz'] ) && $this->_aVars['bIsViewingQuiz']): ?>viewing<?php else: ?>browsing<?php endif; ?>')"><?php echo Phpfox::getPhrase('quiz.delete'); ?></a></li>
<?php endif; ?>
						</ul>			
					</div>
					<div class="row_edit_bar">				
						<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('quiz.actions'); ?></span></a>							
					</div>
				</div>		
<?php endif; ?>
<?php if (Phpfox ::getUserParam('quiz.can_approve_quizzes')): ?>
				<a href="#<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>" class="moderate_link" rel="quiz"><?php echo Phpfox::getPhrase('quiz.moderate'); ?></a>
<?php endif; ?>
			</div>
			<div class="row_title_info">
				<a href="<?php echo Phpfox::permalink('quiz', $this->_aVars['aQuiz']['quiz_id'], $this->_aVars['aQuiz']['title'], false, null, (array) array (
)); ?>" id="quiz_inner_title_<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>" class="link" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aQuiz']['title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aQuiz']['title']), 75, '...'); ?></a>
				<div class="extra_info">
<?php echo Phpfox::getLib('date')->convertTime($this->_aVars['aQuiz']['time_stamp']); ?> <?php echo Phpfox::getPhrase('quiz.by'); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aQuiz']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aQuiz']['user_name'], ((empty($this->_aVars['aQuiz']['user_name']) && isset($this->_aVars['aQuiz']['profile_page_id'])) ? $this->_aVars['aQuiz']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aQuiz']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
				</div>			
			
		
<?php endif; ?>

		<div>
<?php if (isset ( $this->_aVars['aQuiz']['image_path'] ) && $this->_aVars['aQuiz']['image_path'] != ''): ?>
		<div class="item_image" style="width:<?php echo Phpfox::getParam('quiz.quiz_max_image_pic_size'); ?>px;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('thickbox' => true,'server_id' => $this->_aVars['aQuiz']['server_id'],'title' => $this->_aVars['aQuiz']['title'],'path' => 'quiz.url_image','file' => $this->_aVars['aQuiz']['image_path'],'suffix' => $this->_aVars['sSuffix'],'max_width' => 'quiz.quiz_max_image_pic_size','max_height' => 'quiz.quiz_max_image_pic_size')); ?>
		</div>
		<div class="item_image_content" style="margin-left:<?php echo Phpfox::getParam('quiz.quiz_max_image_pic_size'); ?>px;">
<?php endif; ?>
		
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aQuiz']['description']), 55); ?>

<?php if (isset ( $this->_aVars['bShowResults'] ) && $this->_aVars['bShowResults']): ?>
			<?php /* Cached: June 20, 2013, 2:39 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: result.html.php 3193 2011-09-27 11:44:08Z Raymond_Benc $
 */
 
 

?>
<h3>
<?php if (isset ( $this->_aVars['aQuiz']['takerInfo'] )): ?>
<?php echo Phpfox::getPhrase('quiz.quiz_results_for_full_name_percentage_100', array('full_name' => $this->_aVars['aQuiz']['takerInfo']['userinfo']['full_name'],'percentage' => $this->_aVars['aQuiz']['iSuccessPercentage']));  else: ?>
<?php echo Phpfox::getPhrase('quiz.quiz_results_percentage_100', array('percentage' => $this->_aVars['aQuiz']['iSuccessPercentage']));  endif; ?>
</h3>
<?php if (isset ( $this->_aVars['aQuiz']['takerInfo'] )): ?>
		<div style="width:55px; position:absolute;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aQuiz']['takerInfo']['userinfo'],'suffix' => '_50','max_width' => 50,'max_height' => 50)); ?>
		</div>
		<div class="p_2" style="margin-left:60px; height:55px;">
			<div class="extra_info">
<?php echo Phpfox::getPhrase('quiz.taken_on_time_stamp', array('time_stamp' => Phpfox::getTime(Phpfox::getParam('quiz.quiz_view_time_stamp'), $this->_aVars['aQuiz']['takerInfo']['time_stamp']))); ?>
			</div>
		</div>
<?php endif; ?>
<div class="p_4" style="margin-top:10px;">
<?php if (count((array)$this->_aVars['aQuiz']['results'])):  $this->_aPhpfoxVars['iteration']['questions'] = 0;  foreach ((array) $this->_aVars['aQuiz']['results'] as $this->_aVars['aQuestion']):  $this->_aPhpfoxVars['iteration']['questions']++; ?>
	
	<div class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['questions'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['questions'] == 1): ?> row_first<?php endif;  if ($this->_aVars['aQuestion']['userAnswer'] == $this->_aVars['aQuestion']['correctAnswer']): ?> row_is_correct<?php else: ?> row_is_incorrect<?php endif; ?>">
		<b><?php echo $this->_aPhpfoxVars['iteration']['questions']; ?>.</b> <?php echo $this->_aVars['aQuestion']['questionText']; ?>
		<div class="p_4" style="margin-left:30px;">
<?php echo Phpfox::getPhrase('quiz.full_name_s_answer', array('full_name' => $this->_aVars['aQuestion']['full_name'])); ?>: <?php echo $this->_aVars['aQuestion']['userAnswerText']; ?> <br />
<?php echo Phpfox::getPhrase('quiz.correct_answer'); ?>: <?php echo $this->_aVars['aQuestion']['correctAnswerText']; ?> <br />
		</div>
	</div>
<?php endforeach; endif; ?>
</div>

<?php elseif (isset ( $this->_aVars['bShowUsers'] ) && $this->_aVars['bShowUsers']): ?>
			<h3><?php echo Phpfox::getPhrase('quiz.users_results'); ?></h3>
<?php if (count((array)$this->_aVars['aQuiz']['aTakenBy'])):  $this->_aPhpfoxVars['iteration']['users'] = 0;  foreach ((array) $this->_aVars['aQuiz']['aTakenBy'] as $this->_aVars['aUser']):  $this->_aPhpfoxVars['iteration']['users']++; ?>

			<div<?php if (isset ( $this->_aPhpfoxVars['iteration']['results'] )): ?> class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['results'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['results'] == 1): ?> row_first<?php endif; ?>"<?php endif; ?> style="position:relative;">
				<div style="width:55px; position:absolute;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aUser']['user_info'],'suffix' => '_50','max_width' => 50,'max_height' => 50)); ?>
				</div>
				<div class="p_2" style="margin-left:60px; height:55px;">
					<a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("".$this->_aVars['aUser']['user_info']['user_name'].""); ?>"><?php echo $this->_aVars['aUser']['user_info']['full_name']; ?></a> <?php if (( Phpfox ::getParam('quiz.show_percentage_in_results'))):  echo $this->_aVars['aUser']['iSuccessPercentage']; ?>%<?php else:  echo $this->_aVars['aUser']['total_correct']; ?>/<?php echo $this->_aVars['aUser']['iTotalCorrectAnswers'];  endif; ?>.
					<div class="t_right">
						<ul class="item_menu">
							<li><a href="<?php echo Phpfox::permalink('quiz', $this->_aVars['aQuiz']['quiz_id'], $this->_aVars['aQuiz']['title'], false, null, (array) array (
)); ?>results/id_<?php echo $this->_aVars['aUser']['user_info']['user_id']; ?>/" id="quiz_inner_title_<?php echo $this->_aVars['aQuiz']['quiz_id']; ?>"><?php echo Phpfox::getPhrase('quiz.view_results'); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
<?php endforeach; else: ?><div class="t_left"><?php echo Phpfox::getPhrase('quiz.be_the_first_to_answer_this_quiz'); ?></div>
<?php endif; ?>
<?php else: ?>
<?php if (isset ( $this->_aVars['bIsViewingQuiz'] )): ?>
<?php if (isset ( $this->_aVars['aQuiz']['question'] )): ?>
				<form name="js_form_answer" method="post" action="<?php echo Phpfox::permalink('quiz', $this->_aVars['aQuiz']['quiz_id'], $this->_aVars['aQuiz']['title'], false, null, (array) array (
)); ?>answer/">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div class="p_4" style="margin-top:10px;">
<?php if (count((array)$this->_aVars['aQuiz']['question'])):  $this->_aPhpfoxVars['iteration']['questions'] = 0;  foreach ((array) $this->_aVars['aQuiz']['question'] as $this->_aVars['iQuestionId'] => $this->_aVars['aQuestion']):  $this->_aPhpfoxVars['iteration']['questions']++; ?>

							<b><?php echo $this->_aPhpfoxVars['iteration']['questions']; ?>.</b> <?php echo $this->_aVars['aQuestion']['question']; ?>
							<div class="p_4" style="margin-left:30px;">
<?php if (count((array)$this->_aVars['aQuestion']['answer'])):  $this->_aPhpfoxVars['iteration']['answers'] = 0;  foreach ((array) $this->_aVars['aQuestion']['answer'] as $this->_aVars['iAnswerId'] => $this->_aVars['sAnswer']):  $this->_aPhpfoxVars['iteration']['answers']++; ?>

									<div class="p_2">
										<label><input class="checkbox" name="val[answer][<?php echo $this->_aVars['iQuestionId']; ?>]" value="<?php echo $this->_aVars['iAnswerId']; ?>" style="vertical-align: middle;" type="radio"> <?php echo $this->_aVars['sAnswer']; ?></label>
									</div>
<?php endforeach; endif; ?>
							</div>
<?php endforeach; endif; ?>
					</div>
<?php if (isset ( $this->_aVars['aQuiz']['view_id'] ) && $this->_aVars['aQuiz']['view_id'] != 1): ?>
						<input type="submit" value="<?php echo Phpfox::getPhrase('quiz.submit_your_answers'); ?>" class="button" />
<?php endif; ?>
				
</form>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if (isset ( $this->_aVars['aQuiz']['image_path'] ) && $this->_aVars['aQuiz']['image_path'] != ''): ?>
		</div>
		<div class="clear"></div>		
<?php endif; ?>
		
<?php if (! isset ( $this->_aVars['bIsViewingQuiz'] ) && isset ( $this->_aVars['aQuiz']['aFeed'] )): ?>
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aQuiz']['aFeed'])); ?>
<?php endif; ?>
		
<?php if (! isset ( $this->_aVars['bIsViewingQuiz'] )): ?>
			</div>		
		</div>
<?php endif; ?>
	</div>	
</div>
<?php endforeach; endif;  if (Phpfox ::getUserParam('quiz.can_approve_quizzes')):  Phpfox::getBlock('core.moderation');  endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('quiz.no_quizzes_found'); ?>
</div>
<?php endif; ?>
