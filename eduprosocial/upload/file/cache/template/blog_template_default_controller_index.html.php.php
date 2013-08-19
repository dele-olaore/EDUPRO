<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 7:28 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: index.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

 if (! count ( $this->_aVars['aItems'] )): ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('blog.no_blogs_found'); ?>
</div>
<?php else:  if (count((array)$this->_aVars['aItems'])):  $this->_aPhpfoxVars['iteration']['blog'] = 0;  foreach ((array) $this->_aVars['aItems'] as $this->_aVars['aItem']):  $this->_aPhpfoxVars['iteration']['blog']++; ?>

	<?php /* Cached: May 28, 2013, 7:28 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: entry.html.php 4941 2012-10-23 12:43:23Z Miguel_Espinoza $
 */
 
 

?>
<div style="word-wrap:break-word;" id="js_blog_entry<?php echo $this->_aVars['aItem']['blog_id']; ?>"<?php if (! isset ( $this->_aVars['bBlogView'] )): ?> class="moderation_row js_blog_parent <?php if (is_int ( $this->_aPhpfoxVars['iteration']['blog'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if ($this->_aPhpfoxVars['iteration']['blog'] == 1 && ! PHPFOX_IS_AJAX): ?> row_first<?php endif;  if ($this->_aVars['aItem']['is_approved'] != 1): ?> <?php endif; ?>"<?php endif; ?>>	
<?php if (! isset ( $this->_aVars['bBlogView'] )): ?>
	<div class="row_title">	
		<div class="row_title_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aItem'],'suffix' => '_50_square','max_width' => 50,'max_height' => 50)); ?>
<?php if (Phpfox ::getUserParam('blog.can_approve_blogs') || ( Phpfox ::getUserParam('blog.edit_own_blog') && Phpfox ::getUserId() == $this->_aVars['aItem']['user_id'] ) || Phpfox ::getUserParam('blog.edit_user_blog') || ( Phpfox ::getUserParam('blog.delete_own_blog') && Phpfox ::getUserId() == $this->_aVars['aItem']['user_id'] ) || Phpfox ::getUserParam('blog.delete_user_blog')): ?>
			<div class="row_edit_bar_parent">
				<div class="row_edit_bar_holder">
					<ul>
						<?php /* Cached: May 28, 2013, 7:28 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Blog
 * @version 		$Id: entry.html.php 2232 2010-12-03 21:04:43Z Raymond_Benc $
 */
 
 

?>
<?php if (( Phpfox ::getUserParam('blog.edit_own_blog') && Phpfox ::getUserId() == $this->_aVars['aItem']['user_id'] ) || Phpfox ::getUserParam('blog.edit_user_blog')): ?>
						<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("blog.add", array('id' => "".$this->_aVars['aItem']['blog_id']."")); ?>"><?php echo Phpfox::getPhrase('core.edit'); ?></a></li>
<?php endif; ?>
<?php if (( Phpfox ::getUserParam('blog.delete_own_blog') && Phpfox ::getUserId() == $this->_aVars['aItem']['user_id'] ) || Phpfox ::getUserParam('blog.delete_user_blog')): ?>
						<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("blog.delete", array('id' => "".$this->_aVars['aItem']['blog_id']."")); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('blog.are_you_sure_you_want_to_delete_this_blog', array('phpfox_squote' => true)); ?>');" title="<?php echo Phpfox::getPhrase('blog.delete_blog'); ?>"><?php echo Phpfox::getPhrase('core.delete'); ?></a></li>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('blog.template_block_entry_links_main')) ? eval($sPlugin) : false); ?>
					</ul>			
				</div>
				<div class="row_edit_bar">				
						<a href="#" class="row_edit_bar_action"><span><?php echo Phpfox::getPhrase('blog.actions'); ?></span></a>							
				</div>
			</div>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('blog.can_approve_blogs') || Phpfox ::getUserParam('blog.delete_user_blog')): ?><a href="#<?php echo $this->_aVars['aItem']['blog_id']; ?>" class="moderate_link" rel="blog">Moderate</a><?php endif; ?>
		</div>
		<div class="row_title_info">
<?php if ($this->_aVars['aItem']['post_status'] == 2): ?>
<?php echo Phpfox::getPhrase('blog.draft_info'); ?>
<?php endif; ?>
			<span id="js_blog_edit_title<?php echo $this->_aVars['aItem']['blog_id']; ?>">
				<a href="<?php echo Phpfox::permalink('blog', $this->_aVars['aItem']['blog_id'], $this->_aVars['aItem']['title'], false, null, (array) array (
)); ?>" id="js_blog_edit_inner_title<?php echo $this->_aVars['aItem']['blog_id']; ?>" class="link ajax_link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aItem']['title']), 55, '...'), 20); ?></a>
			</span>
			
			<div class="extra_info">
<?php echo Phpfox::getPhrase('blog.by_full_name', array('full_name' => '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aItem']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aItem']['user_name'], ((empty($this->_aVars['aItem']['user_name']) && isset($this->_aVars['aItem']['profile_page_id'])) ? $this->_aVars['aItem']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aItem']['full_name'], 50, '...') . '</a></span>')); ?>
<?php (($sPlugin = Phpfox_Plugin::get('blog.template_block_entry_date_end')) ? eval($sPlugin) : false); ?>
			</div>
		
<?php endif; ?>
		<div class="blog_content">
			<div id="js_blog_edit_text<?php echo $this->_aVars['aItem']['blog_id']; ?>">	
				<div class="item_content item_view_content">
<?php if (isset ( $this->_aVars['bBlogView'] )): ?>
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.search')->highlight('search', Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aItem']['text'])), 55); ?>
<?php else: ?>
					<div class="extra_info">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.search')->highlight('search', strip_tags($this->_aVars['aItem']['text'])), 55), $this->_aVars['iShorten']).'...'; ?>
					</div>
<?php endif; ?>
				</div>			
			</div>	
			
<?php if (isset ( $this->_aVars['bBlogView'] ) && $this->_aVars['aItem']['total_attachment']): ?>
<?php Phpfox::getBlock('attachment.list', array('sType' => 'blog','iItemId' => $this->_aVars['aItem']['blog_id'])); ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aItem']['tag_list'] )): ?>
<?php Phpfox::getBlock('tag.item', array('sType' => $this->_aVars['sTagType'],'sTags' => $this->_aVars['aItem']['tag_list'],'iItemId' => $this->_aVars['aItem']['blog_id'],'iUserId' => $this->_aVars['aItem']['user_id'])); ?>
<?php endif; ?>
			
<?php if (! isset ( $this->_aVars['bBlogView'] )): ?>
<?php Phpfox::getBlock('feed.comment', array('aFeed' => $this->_aVars['aItem']['aFeed'])); ?>
<?php endif; ?>
			
<?php (($sPlugin = Phpfox_Plugin::get('blog.template_block_entry_text_end')) ? eval($sPlugin) : false); ?>
		</div>
	
<?php (($sPlugin = Phpfox_Plugin::get('blog.template_block_entry_end')) ? eval($sPlugin) : false); ?>
<?php if (! isset ( $this->_aVars['bBlogView'] )): ?>
		</div>					
	</div>
<?php endif; ?>
</div>
<?php endforeach; endif;  if (Phpfox ::getUserParam('blog.can_approve_blogs') || Phpfox ::getUserParam('blog.delete_user_blog')):  Phpfox::getBlock('core.moderation');  endif;  unset($this->_aVars['aItems']);  if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  endif; ?>
