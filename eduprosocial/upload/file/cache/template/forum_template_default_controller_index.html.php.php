<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 12:24 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: index.html.php 4074 2012-03-28 14:02:40Z Raymond_Benc $
 */
 
 

?>
<div class="p_bottom_10">
	<ul class="sub_menu_bar">
<?php if (Phpfox ::isUser()): ?>
		<li><a href="#" class="sJsDropMenu drop_down_link"><?php echo Phpfox::getPhrase('forum.quick_links'); ?></a>
			<div class="link_menu dropContent">
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.read'); ?>"><?php echo Phpfox::getPhrase('forum.mark_forums_read'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('view' => 'new')); ?>"><?php echo Phpfox::getPhrase('forum.new_posts'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('view' => 'my-thread')); ?>"><?php echo Phpfox::getPhrase('forum.my_threads'); ?></a></li>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('view' => 'subscribed')); ?>"><?php echo Phpfox::getPhrase('forum.subscribed_threads'); ?></a></li>					
				</ul>
			</div>		
		</li>	
<?php endif; ?>
		<li><a href="#" class="sJsDropMenu drop_down_link"><?php echo Phpfox::getPhrase('forum.search'); ?></a>
			<div class="link_menu dropContent">
				<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
					<div class="div_menu">
						<input type="text" name="search[keyword]" value="" class="v_middle" /> <input name="search[submit]" type="submit" value="<?php echo Phpfox::getPhrase('forum.go'); ?>" class="button v_middle" />
					</div>
					<div class="div_menu">
						<label><input type="radio" name="search[result]" value="0" class="v_middle checkbox" checked="checked" /> <?php echo Phpfox::getPhrase('forum.show_threads'); ?></label>
						<label><input type="radio" name="search[result]" value="1" class="v_middle checkbox" /> <?php echo Phpfox::getPhrase('forum.show_posts'); ?></label>
					</div>
				
</form>

				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search'); ?>"><?php echo Phpfox::getPhrase('forum.advanced_search'); ?></a></li>
				</ul>
			</div>
		</li>		
	</ul>
	<div class="clear"></div>
</div>

<?php if (! count ( $this->_aVars['aForums'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.no_forums_have_been_created'); ?>
<?php if (Phpfox ::getUserParam('forum.can_add_new_forum')): ?>
	<ul class="action">
		<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.forum.add'); ?>"><?php echo Phpfox::getPhrase('forum.create_a_new_forum'); ?></a></li>
	</ul>
<?php endif; ?>
</div>
<?php else:  /* Cached: May 28, 2013, 12:24 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: index.html.php 140 2009-01-30 13:04:09Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['aCallback'] === null && count ( $this->_aVars['aForums'] )):  if (isset ( $this->_aVars['bIsSubForum'] )): ?>
<div class="table_info">
	<b><?php echo Phpfox::getPhrase('forum.sub_forum'); ?>:</b> <?php echo Phpfox::getLib('locale')->convert(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForumData']['name'])); ?>
<?php if (! empty ( $this->_aVars['aForumData']['description'] )): ?>
	<div class="p_4">
<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aForumData']['description']); ?>
	</div>		
<?php endif; ?>
</div>
<?php endif; ?>

<?php if (count((array)$this->_aVars['aForums'])):  $this->_aPhpfoxVars['iteration']['forums'] = 0;  foreach ((array) $this->_aVars['aForums'] as $this->_aVars['aForum']):  $this->_aPhpfoxVars['iteration']['forums']++; ?>

<?php if ($this->_aVars['aForum']['is_category']): ?>
<div class="table_info">
	<a href="<?php echo Phpfox::permalink('forum', $this->_aVars['aForum']['forum_id'], $this->_aVars['aForum']['name'], false, null, (array) array (
)); ?>"<?php if (! empty ( $this->_aVars['aForum']['description'] )): ?> title="<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aForum']['description']); ?>" <?php endif; ?>><?php echo Phpfox::getLib('locale')->convert(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['name'])); ?></a>	
</div>
<?php if (count ( $this->_aVars['aForum']['sub_forum'] )): ?>
<?php if (count((array)$this->_aVars['aForum']['sub_forum'])):  foreach ((array) $this->_aVars['aForum']['sub_forum'] as $this->_aVars['aForum']): ?>
		<?php /* Cached: May 28, 2013, 12:24 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: forum.html.php 4868 2012-10-09 08:57:09Z Raymond_Benc $
 */
 
 

?>
		<div class="table_row">
			<div class="forum_image">
				<div class="forum_large_<?php if ($this->_aVars['aForum']['is_closed']): ?>closed<?php else:  if ($this->_aVars['aForum']['is_seen']): ?>old<?php else: ?>new<?php endif;  endif; ?>" title="<?php if ($this->_aVars['aForum']['is_closed']):  echo Phpfox::getPhrase('forum.forum_is_closed_for_posting');  else:  if ($this->_aVars['aForum']['is_seen']):  echo Phpfox::getPhrase('forum.forum_contains_no_new_posts');  else:  echo Phpfox::getPhrase('forum.forum_contains_new_posts');  endif;  endif; ?>"><?php echo $this->_aVars['aForum']['is_seen']; ?></div>
			</div>			
			<div class="forum_title">
					<a href="<?php echo Phpfox::permalink('forum', $this->_aVars['aForum']['forum_id'], $this->_aVars['aForum']['name'], false, null, (array) array (
)); ?>"<?php if (! empty ( $this->_aVars['aForum']['description'] )): ?> title="<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aForum']['description']); ?>" <?php endif; ?> class="forum_title_link"><?php echo Phpfox::getLib('locale')->convert(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['name'])); ?></a>					
					<div class="extra_info">
						<ul class="extra_info_middot">						
							<li><?php echo Phpfox::getPhrase('forum.threads'); ?>: <?php echo number_format($this->_aVars['aForum']['total_thread']); ?></li>
							<li>&middot;</li>
							<li><?php echo Phpfox::getPhrase('forum.posts'); ?>: <?php echo number_format($this->_aVars['aForum']['total_post']); ?></li>
						</ul>
					</div>
<?php if (Phpfox ::isMobile() && ! empty ( $this->_aVars['aForum']['thread_title'] )): ?>
					<div class="forum_last_post">
						<a href="<?php if ($this->_aVars['aForum']['post_id']):  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aForum']['post_id']; ?>/<?php else:  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
));  endif; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']), 20), 50, '...'); ?>
						</a>
						<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aForum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aForum']['user_name'], ((empty($this->_aVars['aForum']['user_name']) && isset($this->_aVars['aForum']['profile_page_id'])) ? $this->_aVars['aForum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForum']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aForum']['thread_time_stamp']))); ?>
						</div>					
					</div>						
<?php endif; ?>
<?php if (isset ( $this->_aVars['aForum']['moderators'] )): ?>
<?php echo Phpfox::getPhrase('forum.moderated_by'); ?>: <?php if (count((array)$this->_aVars['aForum']['moderators'])):  $this->_aPhpfoxVars['iteration']['moderators'] = 0;  foreach ((array) $this->_aVars['aForum']['moderators'] as $this->_aVars['aModerator']):  $this->_aPhpfoxVars['iteration']['moderators']++;  if ($this->_aPhpfoxVars['iteration']['moderators'] != 1): ?>, <?php endif;  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aModerator']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aModerator']['user_name'], ((empty($this->_aVars['aModerator']['user_name']) && isset($this->_aVars['aModerator']['profile_page_id'])) ? $this->_aVars['aModerator']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aModerator']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  endforeach; endif; ?>
<?php endif; ?>
			</div>
<?php if (! Phpfox ::isMobile() && ! empty ( $this->_aVars['aForum']['thread_title'] )): ?>
			<div class="forum_last_post">
				<a href="<?php if ($this->_aVars['aForum']['post_id']):  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aForum']['post_id']; ?>/<?php else:  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
));  endif; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']), 50, '...'); ?>
				</a>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aForum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aForum']['user_name'], ((empty($this->_aVars['aForum']['user_name']) && isset($this->_aVars['aForum']['profile_page_id'])) ? $this->_aVars['aForum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForum']['full_name'], 30, '...') . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aForum']['thread_time_stamp']))); ?>
				</div>					
			</div>	
<?php endif; ?>
		</div>
<?php endforeach; endif; ?>
		<br />
<?php endif;  else: ?>
<?php if (! isset ( $this->_aVars['bIsSubForum'] ) && $this->_aPhpfoxVars['iteration']['forums'] == 1): ?>
	<div class="table_info">
<?php echo Phpfox::getPhrase('forum.forums'); ?>
	</div>
<?php endif; ?>
	<?php /* Cached: May 28, 2013, 12:24 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: forum.html.php 4868 2012-10-09 08:57:09Z Raymond_Benc $
 */
 
 

?>
		<div class="table_row">
			<div class="forum_image">
				<div class="forum_large_<?php if ($this->_aVars['aForum']['is_closed']): ?>closed<?php else:  if ($this->_aVars['aForum']['is_seen']): ?>old<?php else: ?>new<?php endif;  endif; ?>" title="<?php if ($this->_aVars['aForum']['is_closed']):  echo Phpfox::getPhrase('forum.forum_is_closed_for_posting');  else:  if ($this->_aVars['aForum']['is_seen']):  echo Phpfox::getPhrase('forum.forum_contains_no_new_posts');  else:  echo Phpfox::getPhrase('forum.forum_contains_new_posts');  endif;  endif; ?>"><?php echo $this->_aVars['aForum']['is_seen']; ?></div>
			</div>			
			<div class="forum_title">
					<a href="<?php echo Phpfox::permalink('forum', $this->_aVars['aForum']['forum_id'], $this->_aVars['aForum']['name'], false, null, (array) array (
)); ?>"<?php if (! empty ( $this->_aVars['aForum']['description'] )): ?> title="<?php echo Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aForum']['description']); ?>" <?php endif; ?> class="forum_title_link"><?php echo Phpfox::getLib('locale')->convert(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['name'])); ?></a>					
					<div class="extra_info">
						<ul class="extra_info_middot">						
							<li><?php echo Phpfox::getPhrase('forum.threads'); ?>: <?php echo number_format($this->_aVars['aForum']['total_thread']); ?></li>
							<li>&middot;</li>
							<li><?php echo Phpfox::getPhrase('forum.posts'); ?>: <?php echo number_format($this->_aVars['aForum']['total_post']); ?></li>
						</ul>
					</div>
<?php if (Phpfox ::isMobile() && ! empty ( $this->_aVars['aForum']['thread_title'] )): ?>
					<div class="forum_last_post">
						<a href="<?php if ($this->_aVars['aForum']['post_id']):  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aForum']['post_id']; ?>/<?php else:  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
));  endif; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']), 20), 50, '...'); ?>
						</a>
						<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aForum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aForum']['user_name'], ((empty($this->_aVars['aForum']['user_name']) && isset($this->_aVars['aForum']['profile_page_id'])) ? $this->_aVars['aForum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForum']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aForum']['thread_time_stamp']))); ?>
						</div>					
					</div>						
<?php endif; ?>
<?php if (isset ( $this->_aVars['aForum']['moderators'] )): ?>
<?php echo Phpfox::getPhrase('forum.moderated_by'); ?>: <?php if (count((array)$this->_aVars['aForum']['moderators'])):  $this->_aPhpfoxVars['iteration']['moderators'] = 0;  foreach ((array) $this->_aVars['aForum']['moderators'] as $this->_aVars['aModerator']):  $this->_aPhpfoxVars['iteration']['moderators']++;  if ($this->_aPhpfoxVars['iteration']['moderators'] != 1): ?>, <?php endif;  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aModerator']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aModerator']['user_name'], ((empty($this->_aVars['aModerator']['user_name']) && isset($this->_aVars['aModerator']['profile_page_id'])) ? $this->_aVars['aModerator']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aModerator']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  endforeach; endif; ?>
<?php endif; ?>
			</div>
<?php if (! Phpfox ::isMobile() && ! empty ( $this->_aVars['aForum']['thread_title'] )): ?>
			<div class="forum_last_post">
				<a href="<?php if ($this->_aVars['aForum']['post_id']):  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aForum']['post_id']; ?>/<?php else:  echo Phpfox::permalink('forum.thread', $this->_aVars['aForum']['thread_id'], $this->_aVars['aForum']['thread_title_url'], false, null, (array) array (
));  endif; ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForum']['thread_title']), 50, '...'); ?>
				</a>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aForum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aForum']['user_name'], ((empty($this->_aVars['aForum']['user_name']) && isset($this->_aVars['aForum']['profile_page_id'])) ? $this->_aVars['aForum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aForum']['full_name'], 30, '...') . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aForum']['thread_time_stamp']))); ?>
				</div>					
			</div>	
<?php endif; ?>
		</div>
<?php endif;  endforeach; endif; ?>

<?php if (isset ( $this->_aVars['bIsSubForum'] )): ?>
<br />
<?php endif; ?>

<?php endif;  endif; ?>
