<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:37 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: index.html.php 1544 2010-04-07 13:20:17Z Raymond_Benc $
 */
 
 

?>
<div class="table_header">
<?php echo Phpfox::getPhrase('rss.feeds'); ?>
</div>
<table id="js_drag_drop" cellpadding="0" cellspacing="0">
	<tr>
		<th></th>
		<th style="width:20px;"></th>
		<th><?php echo Phpfox::getPhrase('rss.title'); ?></th>
		<th class="t_center"><?php echo Phpfox::getPhrase('rss.subscribers'); ?></th>
		<th class="t_center" style="width:80px;"><?php echo Phpfox::getPhrase('rss.site_wide'); ?></th>
		<th class="t_center" style="width:60px;"><?php echo Phpfox::getPhrase('rss.active'); ?></th>
	</tr>
<?php if (count((array)$this->_aVars['aFeeds'])):  foreach ((array) $this->_aVars['aFeeds'] as $this->_aVars['iKey'] => $this->_aVars['aFeed']): ?>
	<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
		<td class="drag_handle"><input type="hidden" name="val[ordering][<?php echo $this->_aVars['aFeed']['group_id']; ?>]" value="<?php echo $this->_aVars['aFeed']['ordering']; ?>" /></td>
		<td class="t_center">
			<a href="#" class="js_drop_down_link" title="Manage"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
			<div class="link_menu">
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.rss.add', array('id' => $this->_aVars['aFeed']['feed_id'])); ?>"><?php echo Phpfox::getPhrase('rss.edit_feed'); ?></a></li>		
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.rss', array('delete' => $this->_aVars['aFeed']['feed_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('rss.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('rss.delete_feed'); ?></a></li>					
				</ul>
			</div>		
		</td>	
		<td><?php echo Phpfox::getPhrase($this->_aVars['aFeed']['title_var']); ?></td>
		<td class="t_center">
<?php if ($this->_aVars['aFeed']['total_subscribed'] > 0): ?><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.rss.log', array('id' => $this->_aVars['aFeed']['feed_id'])); ?>"><?php endif;  echo $this->_aVars['aFeed']['total_subscribed'];  if ($this->_aVars['aFeed']['total_subscribed'] > 0): ?></a><?php endif; ?>
		</td>
		<td class="t_center">
			<div class="js_item_is_active"<?php if (! $this->_aVars['aFeed']['is_site_wide']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=rss.updateSiteWide&amp;id=<?php echo $this->_aVars['aFeed']['feed_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('rss.disable'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
			</div>
			<div class="js_item_is_not_active"<?php if ($this->_aVars['aFeed']['is_site_wide']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=rss.updateSiteWide&amp;id=<?php echo $this->_aVars['aFeed']['feed_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('rss.enable'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
			</div>		
		</td>
		<td class="t_center">
			<div class="js_item_is_active"<?php if (! $this->_aVars['aFeed']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=rss.updateFeedActivity&amp;id=<?php echo $this->_aVars['aFeed']['feed_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('rss.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
			</div>
			<div class="js_item_is_not_active"<?php if ($this->_aVars['aFeed']['is_active']): ?> style="display:none;"<?php endif; ?>>
				<a href="#?call=rss.updateFeedActivity&amp;id=<?php echo $this->_aVars['aFeed']['feed_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('rss.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
			</div>		
		</td>
	</tr>
<?php endforeach; endif; ?>
</table>
