<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 31, 2013, 3:13 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: $
 */
 
 

 if (! $this->_aVars['bIsSearch']):  if ($this->_aVars['aCallback'] === null): ?>	
<?php if (! $this->_aVars['aForumData']['is_closed'] && Phpfox ::getUserParam('forum.can_add_new_thread') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aForumData']['forum_id'] . '' , 'add_thread' )): ?>
	<div class="sub_menu_bar_main"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('id' => $this->_aVars['aForumData']['forum_id'])); ?>"><?php echo Phpfox::getPhrase('forum.new_thread'); ?></a></div>
<?php endif;  else: ?>
	<div class="sub_menu_bar_main"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('module' => $this->_aVars['aCallback']['module_id'],'item' => $this->_aVars['aCallback']['item_id'])); ?>"><?php echo Phpfox::getPhrase('forum.new_thread'); ?></a></div>
<?php endif; ?>
<?php endif;  if (count ( $this->_aVars['aThreads'] )):  if (! $this->_aVars['bIsSearch']): ?>

<div class="forum_header_menu">
	<ul class="sub_menu_bar">	
<?php if (Phpfox ::isUser()): ?>
		<li class="sub_menu_bar_li"><a href="#" class="sJsDropMenu drop_down_link"><?php echo Phpfox::getPhrase('forum.forum_tools'); ?></a>
			<div class="link_menu dropContent">
				<ul>
<?php if ($this->_aVars['aCallback'] === null): ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.read', array('forum' => $this->_aVars['aForumData']['forum_id'])); ?>"><?php echo Phpfox::getPhrase('forum.mark_this_forum_read'); ?></a></li>
<?php else: ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.read', array('module' => $this->_aVars['aCallback']['module_id'],'item' => $this->_aVars['aCallback']['item_id'])); ?>"><?php echo Phpfox::getPhrase('forum.mark_this_forum_read'); ?></a></li>
<?php endif; ?>
				</ul>
			</div>		
		</li>
<?php endif; ?>
		<li class="sub_menu_bar_li"><a href="#" class="sJsDropMenu drop_down_link"><?php echo Phpfox::getPhrase('forum.search_this_forum'); ?></a>
			<div class="link_menu dropContent">
				<form method="post" action="<?php if ($this->_aVars['aCallback'] !== null):  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('module' => $this->_aVars['aCallback']['module_id'],'item' => $this->_aVars['aCallback']['item_id']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search');  endif; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['aCallback'] === null): ?>
				<div><input type="hidden" name="search[forum][]" value="<?php echo $this->_aVars['aForumData']['forum_id']; ?>" /></div>
<?php else: ?>
				<div><input type="hidden" name="search[item_id]" value="<?php echo $this->_aVars['aCallback']['item_id']; ?>" /></div>
<?php endif; ?>
					<div class="div_menu">
						<input type="text" name="search[keyword]" value="" class="v_middle" /> <input name="search[submit]" type="submit" value="Go" class="button v_middle" />
					</div>
					<div class="div_menu">
						<label><input type="radio" name="search[result]" value="0" class="v_middle checkbox" checked="checked" /> <?php echo Phpfox::getPhrase('forum.show_threads'); ?></label>
						<label><input type="radio" name="search[result]" value="1" class="v_middle checkbox" /> <?php echo Phpfox::getPhrase('forum.show_posts'); ?></label>
					</div>
				
</form>

				<ul>
<?php if ($this->_aVars['aCallback'] === null): ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('id' => $this->_aVars['aForumData']['forum_id'])); ?>"><?php echo Phpfox::getPhrase('forum.advanced_search'); ?></a></li>
<?php else: ?>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('module' => $this->_aVars['aCallback']['module_id'],'item' => $this->_aVars['aCallback']['item_id'])); ?>"><?php echo Phpfox::getPhrase('forum.advanced_search'); ?></a></li>
<?php endif; ?>
				</ul>
			</div>
		</li>		
		<li class="sub_menu_bar_li">
			<a href="<?php if ($this->_aVars['aCallback'] === null):  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.rss', array('forum' => $this->_aVars['aForumData']['forum_id']));  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.rss', array('pages' => $this->_aVars['aCallback']['item_id']));  endif; ?>" title="<?php echo Phpfox::getPhrase('forum.subscribe_to_this_forum'); ?>" class="no_ajax_link">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'rss/tiny.png','class' => 'v_middle')); ?>
			</a>
		</li>
	</ul>
	<div class="clear"></div>
</div>
<?php endif; ?>

<?php endif; ?>

<?php if ($this->_aVars['aCallback'] === null && ! $this->_aVars['bIsSearch']):  /* Cached: May 31, 2013, 3:13 am */  
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
		<?php /* Cached: May 31, 2013, 3:13 am */  
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
	<?php /* Cached: May 31, 2013, 3:13 am */  
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

<?php if (! $this->_aVars['bIsSearch'] && count ( $this->_aVars['aAnnouncements'] )): ?>
<div class="table_info">
<?php echo Phpfox::getPhrase('forum.announcements'); ?>
</div>
<?php if (count((array)$this->_aVars['aAnnouncements'])):  foreach ((array) $this->_aVars['aAnnouncements'] as $this->_aVars['aThread']): ?>
	<?php /* Cached: May 31, 2013, 3:13 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: thread-entry.html.php 4350 2012-06-26 10:22:46Z Miguel_Espinoza $
 */
 
 

?>
<div class="forum_row js_selector_class_<?php echo $this->_aVars['aThread']['thread_id']; ?> checkRow table_row<?php if ($this->_aVars['aThread']['is_announcement']): ?> forum_announcement<?php endif;  if ($this->_aVars['aThread']['order_id'] == 1): ?> forum_sticky <?php elseif ($this->_aVars['aThread']['order_id'] == 2 && ! defined ( 'PHPFOX_IS_GROUP_VIEW' )): ?> forum_sponsor <?php endif;  if ($this->_aVars['aThread']['view_id']): ?> row_moderate<?php endif; ?>">
	<div class="forum_image">
		<div class="forum_image_holder">
			<div class="forum_mini_<?php echo $this->_aVars['aThread']['css_class']; ?> js_hover_title"><div class="js_hover_info"><?php echo $this->_aVars['aThread']['css_class_phrase']; ?></div></div>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aThread'],'suffix' => '_50_square')); ?>
		</div>		
<?php if (Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getUserParam('forum.can_delete_other_posts')): ?><a href="#<?php echo $this->_aVars['aThread']['thread_id']; ?>" class="moderate_link" rel="forum"><?php echo Phpfox::getPhrase('forum.moderate'); ?></a><?php endif; ?>
	</div>
	<div class="forum_title">
		<div class="forum_title_inner_holder">
<?php if ($this->_aVars['aThread']['order_id'] == 1): ?>
				<span class="forum_tag_sticky"><?php echo Phpfox::getPhrase('forum.sticky'); ?></span>: 
<?php endif; ?>
			<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>" class="forum_thread_link<?php if ($this->_aVars['aThread']['css_class'] == 'new'): ?> forum_thread_link_new<?php endif; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aThread']['title']), 40), 100, '...'); ?></a>
			<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], 50, '...') . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aThread']['time_stamp']))); ?>
			</div>
		</div>
		
<?php if (! $this->_aVars['aThread']['is_announcement']): ?>
<?php if (Phpfox ::isMobile()): ?>
		<div class="forum_thread_total">
			<div class="extra_info">
				<ul class="extra_info_middot"><?php if ($this->_aVars['aThread']['poll_id']): ?><li><span class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/chart_bar.png','class' => 'v_middle')); ?><span class="js_hover_info"><?php echo Phpfox::getPhrase('forum.this_thread_contains_a_poll'); ?></span></span></li><?php endif; ?><li><?php echo Phpfox::getPhrase('forum.replies'); ?>: <?php echo number_format($this->_aVars['aThread']['total_post']); ?></li><li>&middot;</li><li><?php echo Phpfox::getPhrase('forum.views'); ?>: <?php echo number_format($this->_aVars['aThread']['total_view']); ?></li></ul>
			</div>
		</div>	
		<div class="forum_thread_last_post">
			<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aThread']['post_id']; ?>/"><?php echo Phpfox::getTime(Phpfox::getParam('forum.forum_time_stamp'), $this->_aVars['aThread']['time_update']); ?></a>
			<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by'); ?> <?php if ($this->_aVars['aThread']['last_user_id']):  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['last_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['last_user_name'], ((empty($this->_aVars['aThread']['last_user_name']) && isset($this->_aVars['aThread']['last_profile_page_id'])) ? $this->_aVars['aThread']['last_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['last_full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  else:  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  endif; ?>
			</div>
		</div>
<?php endif; ?>
<?php endif; ?>
	</div>
<?php if (! $this->_aVars['aThread']['is_announcement']): ?>
<?php if (! Phpfox ::isMobile()): ?>
	<div class="forum_thread_total">
		<div class="extra_info">
			<ul class="extra_info_middot"><?php if ($this->_aVars['aThread']['poll_id']): ?><li><span class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/chart_bar.png','class' => 'v_middle')); ?><span class="js_hover_info"><?php echo Phpfox::getPhrase('forum.this_thread_contains_a_poll'); ?></span></span></li><?php endif; ?><li><?php echo Phpfox::getPhrase('forum.replies'); ?>: <?php echo number_format($this->_aVars['aThread']['total_post']); ?></li><li>&middot;</li><li><?php echo Phpfox::getPhrase('forum.views'); ?>: <?php echo number_format($this->_aVars['aThread']['total_view']); ?></li></ul>
		</div>
	</div>	
	<div class="forum_thread_last_post">
		<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aThread']['post_id']; ?>/"><?php echo Phpfox::getTime(Phpfox::getParam('forum.forum_time_stamp'), $this->_aVars['aThread']['time_update']); ?></a>
		<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by'); ?> <?php if ($this->_aVars['aThread']['last_user_id']):  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['last_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['last_user_name'], ((empty($this->_aVars['aThread']['last_user_name']) && isset($this->_aVars['aThread']['last_profile_page_id'])) ? $this->_aVars['aThread']['last_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['last_full_name'], 50, '...') . '</a></span>';  else:  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], 50, '...') . '</a></span>';  endif; ?>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>
</div>
<?php endforeach; endif;  endif; ?>

<?php if (count ( $this->_aVars['aThreads'] )): ?>

<?php if (isset ( $this->_aVars['bResult'] ) && $this->_aVars['bResult']): ?>

<div class="table_info">
<?php echo Phpfox::getPhrase('forum.posts'); ?>
</div>

<?php if (count((array)$this->_aVars['aThreads'])):  foreach ((array) $this->_aVars['aThreads'] as $this->_aVars['aPost']): ?>
	<?php /* Cached: May 31, 2013, 3:13 am */ 
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
<?php endif;  endforeach; endif; ?>

<?php else: ?>

<div class="table_info">
<?php echo Phpfox::getPhrase('forum.threads'); ?>
</div>

<?php if (count((array)$this->_aVars['aThreads'])):  foreach ((array) $this->_aVars['aThreads'] as $this->_aVars['aThread']): ?>
	<?php /* Cached: May 31, 2013, 3:13 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Forum
 * @version 		$Id: thread-entry.html.php 4350 2012-06-26 10:22:46Z Miguel_Espinoza $
 */
 
 

?>
<div class="forum_row js_selector_class_<?php echo $this->_aVars['aThread']['thread_id']; ?> checkRow table_row<?php if ($this->_aVars['aThread']['is_announcement']): ?> forum_announcement<?php endif;  if ($this->_aVars['aThread']['order_id'] == 1): ?> forum_sticky <?php elseif ($this->_aVars['aThread']['order_id'] == 2 && ! defined ( 'PHPFOX_IS_GROUP_VIEW' )): ?> forum_sponsor <?php endif;  if ($this->_aVars['aThread']['view_id']): ?> row_moderate<?php endif; ?>">
	<div class="forum_image">
		<div class="forum_image_holder">
			<div class="forum_mini_<?php echo $this->_aVars['aThread']['css_class']; ?> js_hover_title"><div class="js_hover_info"><?php echo $this->_aVars['aThread']['css_class_phrase']; ?></div></div>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aThread'],'suffix' => '_50_square')); ?>
		</div>		
<?php if (Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getUserParam('forum.can_delete_other_posts')): ?><a href="#<?php echo $this->_aVars['aThread']['thread_id']; ?>" class="moderate_link" rel="forum"><?php echo Phpfox::getPhrase('forum.moderate'); ?></a><?php endif; ?>
	</div>
	<div class="forum_title">
		<div class="forum_title_inner_holder">
<?php if ($this->_aVars['aThread']['order_id'] == 1): ?>
				<span class="forum_tag_sticky"><?php echo Phpfox::getPhrase('forum.sticky'); ?></span>: 
<?php endif; ?>
			<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>" class="forum_thread_link<?php if ($this->_aVars['aThread']['css_class'] == 'new'): ?> forum_thread_link_new<?php endif; ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aThread']['title']), 40), 100, '...'); ?></a>
			<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by_full_name_on_time', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], 50, '...') . '</a></span>','time' => Phpfox::getLib('date')->convertTime($this->_aVars['aThread']['time_stamp']))); ?>
			</div>
		</div>
		
<?php if (! $this->_aVars['aThread']['is_announcement']): ?>
<?php if (Phpfox ::isMobile()): ?>
		<div class="forum_thread_total">
			<div class="extra_info">
				<ul class="extra_info_middot"><?php if ($this->_aVars['aThread']['poll_id']): ?><li><span class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/chart_bar.png','class' => 'v_middle')); ?><span class="js_hover_info"><?php echo Phpfox::getPhrase('forum.this_thread_contains_a_poll'); ?></span></span></li><?php endif; ?><li><?php echo Phpfox::getPhrase('forum.replies'); ?>: <?php echo number_format($this->_aVars['aThread']['total_post']); ?></li><li>&middot;</li><li><?php echo Phpfox::getPhrase('forum.views'); ?>: <?php echo number_format($this->_aVars['aThread']['total_view']); ?></li></ul>
			</div>
		</div>	
		<div class="forum_thread_last_post">
			<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aThread']['post_id']; ?>/"><?php echo Phpfox::getTime(Phpfox::getParam('forum.forum_time_stamp'), $this->_aVars['aThread']['time_update']); ?></a>
			<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by'); ?> <?php if ($this->_aVars['aThread']['last_user_id']):  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['last_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['last_user_name'], ((empty($this->_aVars['aThread']['last_user_name']) && isset($this->_aVars['aThread']['last_profile_page_id'])) ? $this->_aVars['aThread']['last_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['last_full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  else:  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>';  endif; ?>
			</div>
		</div>
<?php endif; ?>
<?php endif; ?>
	</div>
<?php if (! $this->_aVars['aThread']['is_announcement']): ?>
<?php if (! Phpfox ::isMobile()): ?>
	<div class="forum_thread_total">
		<div class="extra_info">
			<ul class="extra_info_middot"><?php if ($this->_aVars['aThread']['poll_id']): ?><li><span class="js_hover_title"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/chart_bar.png','class' => 'v_middle')); ?><span class="js_hover_info"><?php echo Phpfox::getPhrase('forum.this_thread_contains_a_poll'); ?></span></span></li><?php endif; ?><li><?php echo Phpfox::getPhrase('forum.replies'); ?>: <?php echo number_format($this->_aVars['aThread']['total_post']); ?></li><li>&middot;</li><li><?php echo Phpfox::getPhrase('forum.views'); ?>: <?php echo number_format($this->_aVars['aThread']['total_view']); ?></li></ul>
		</div>
	</div>	
	<div class="forum_thread_last_post">
		<a href="<?php echo Phpfox::permalink('forum.thread', $this->_aVars['aThread']['thread_id'], $this->_aVars['aThread']['title'], false, null, (array) array (
)); ?>post_<?php echo $this->_aVars['aThread']['post_id']; ?>/"><?php echo Phpfox::getTime(Phpfox::getParam('forum.forum_time_stamp'), $this->_aVars['aThread']['time_update']); ?></a>
		<div class="extra_info_link">
<?php echo Phpfox::getPhrase('forum.by'); ?> <?php if ($this->_aVars['aThread']['last_user_id']):  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['last_user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['last_user_name'], ((empty($this->_aVars['aThread']['last_user_name']) && isset($this->_aVars['aThread']['last_profile_page_id'])) ? $this->_aVars['aThread']['last_profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['last_full_name'], 50, '...') . '</a></span>';  else:  echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aThread']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aThread']['user_name'], ((empty($this->_aVars['aThread']['user_name']) && isset($this->_aVars['aThread']['profile_page_id'])) ? $this->_aVars['aThread']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aThread']['full_name'], 50, '...') . '</a></span>';  endif; ?>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>
</div>
<?php endforeach; endif; ?>

<?php endif; ?>

<?php if (! isset ( $this->_aVars['bIsPostSearch'] ) && ( Phpfox ::getUserParam('forum.can_approve_forum_thread') || Phpfox ::getUserParam('forum.can_delete_other_posts'))):  Phpfox::getBlock('core.moderation');  endif;  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>

<?php if (! $this->_aVars['bIsSearch']):  if ($this->_aVars['aCallback'] === null): ?>
<?php if (! $this->_aVars['aForumData']['is_closed'] && Phpfox ::getUserParam('forum.can_add_new_thread') || Phpfox ::getService('forum.moderate')->hasAccess('' . $this->_aVars['aForumData']['forum_id'] . '' , 'add_thread' )): ?>
	<div class="sub_menu_bar_main sub_menu_bar_main_bottom"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('id' => $this->_aVars['aForumData']['forum_id'])); ?>"><?php echo Phpfox::getPhrase('forum.new_thread'); ?></a></div>
<?php endif;  else: ?>
	<div class="sub_menu_bar_main sub_menu_bar_main_bottom"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('forum.post.thread', array('module' => $this->_aVars['aCallback']['module_id'],'item' => $this->_aVars['aCallback']['item_id'])); ?>"><?php echo Phpfox::getPhrase('forum.new_thread'); ?></a></div>
<?php endif;  endif; ?>

<?php if (! $this->_aVars['bIsTagSearch']): ?>

<?php endif; ?>

<?php else: ?>
<div class="extra_info">
<?php if ($this->_aVars['bIsSearch']): ?>
<?php echo Phpfox::getPhrase('forum.nothing_found');  else: ?>
<?php echo Phpfox::getPhrase('forum.no_threads_found');  endif; ?>
	<br />
	<br />
</div>
<?php endif; ?>

<?php if ($this->_aVars['aCallback'] === null):  Phpfox::getBlock('forum.jump', array());  endif; ?>
