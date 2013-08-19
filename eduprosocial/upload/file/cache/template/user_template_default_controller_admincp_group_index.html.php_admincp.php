<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:09 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: index.html.php 2826 2011-08-11 19:41:03Z Raymond_Benc $
 */
 
 

?>
<div class="table_header">
<?php echo Phpfox::getPhrase('user.default_user_groups'); ?>
</div>
<table>
<tr>
	<th style="width:20px;"></th>
	<th><?php echo Phpfox::getPhrase('user.title'); ?></th>
	<th style="width:100px;"><?php echo Phpfox::getPhrase('user.users'); ?></th>
</tr>
<?php if (count((array)$this->_aVars['aGroups']['special'])):  foreach ((array) $this->_aVars['aGroups']['special'] as $this->_aVars['iKey'] => $this->_aVars['aGroup']): ?>
<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
	<td class="t_center">
<?php if (Phpfox ::getUserParam('user.can_edit_user_group') || Phpfox ::getUserParam('user.can_manage_user_group_settings')): ?>
		<a href="#" class="js_drop_down_link" title="Manage"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
		<div class="link_menu">
			<ul>
<?php if (Phpfox ::getUserParam('user.can_manage_user_group_settings')): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add', array('id' => $this->_aVars['aGroup']['user_group_id'],'setting' => 'true')); ?>"><?php echo Phpfox::getPhrase('user.manage_user_settings'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('user.can_edit_user_group')): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add', array('id' => $this->_aVars['aGroup']['user_group_id'])); ?>"><?php echo Phpfox::getPhrase('user.edit_user_group'); ?></a></li>				
<?php endif; ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.activitypoints', array('id' => $this->_aVars['aGroup']['user_group_id'])); ?>"><?php echo Phpfox::getPhrase('core.manage_activity_points'); ?></a></li>
			</ul>
		</div>		
<?php endif; ?>
	</td>	
	<td><?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('locale')->convert($this->_aVars['aGroup']['title'])); ?></td>
	<td><?php if ($this->_aVars['aGroup']['user_group_id'] == 3): ?>N/A<?php else:  echo $this->_aVars['aGroup']['total_users'];  endif; ?></td>
</tr>
<?php endforeach; endif; ?>
</table>
<?php if (isset ( $this->_aVars['aGroups']['custom'] )): ?>
<div class="table_header">
<?php echo Phpfox::getPhrase('user.custom_user_groups'); ?>
</div>
<table>
<tr>
	<th style="width:20px;"></th>
	<th><?php echo Phpfox::getPhrase('user.title'); ?></th>
	<th style="width:100px;"><?php echo Phpfox::getPhrase('user.users'); ?></th>
</tr>
<?php if (count((array)$this->_aVars['aGroups']['custom'])):  foreach ((array) $this->_aVars['aGroups']['custom'] as $this->_aVars['iKey'] => $this->_aVars['aGroup']): ?>
<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
	<td class="t_center">
<?php if (Phpfox ::getUserParam('user.can_edit_user_group') || Phpfox ::getUserParam('user.can_manage_user_group_settings') || Phpfox ::getUserParam('user.can_delete_user_group')): ?>
		<a href="#" class="js_drop_down_link" title="Manage"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
		<div class="link_menu">
			<ul>
<?php if (Phpfox ::getUserParam('user.can_manage_user_group_settings')): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add', array('id' => $this->_aVars['aGroup']['user_group_id'],'setting' => 'true')); ?>"><?php echo Phpfox::getPhrase('user.manage_user_settings'); ?></a></li>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('user.can_edit_user_group')): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add', array('id' => $this->_aVars['aGroup']['user_group_id'])); ?>"><?php echo Phpfox::getPhrase('user.edit_user_group'); ?></a></li>
<?php endif; ?>
<?php if (! $this->_aVars['aGroup']['is_special'] && Phpfox ::getUserParam('user.can_delete_user_group')): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.delete', array('id' => $this->_aVars['aGroup']['user_group_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('user.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('user.delete'); ?></a></li>					
<?php endif; ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.activitypoints', array('id' => $this->_aVars['aGroup']['user_group_id'])); ?>"><?php echo Phpfox::getPhrase('core.manage_activity_points'); ?></a></li>
			</ul>
		</div>	
<?php endif; ?>
	</td>	
	<td><?php echo Phpfox::getLib('phpfox.parse.output')->clean(Phpfox::getLib('locale')->convert($this->_aVars['aGroup']['title'])); ?></td>
	<td><?php if ($this->_aVars['aGroup']['user_group_id'] == 3):  echo Phpfox::getPhrase('user.n_a');  else:  echo $this->_aVars['aGroup']['total_users'];  endif; ?></td>	
</tr>
<?php endforeach; endif; ?>
</table>
<?php endif; ?>
