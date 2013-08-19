<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: January 28, 2013, 9:05 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: index.html.php 2826 2011-08-11 19:41:03Z Raymond_Benc $
 */
 
 

?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu', array('parent' => $this->_aVars['iParentId'])); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<table cellpadding="0" cellspacing="0">
<?php if ($this->_aVars['iParentId'] === 0): ?>
	<tr>
		<td colspan="5" class="table_header">
<?php echo Phpfox::getPhrase('admincp.menu_block'); ?>
		</td>
	</tr>	
<?php if (count((array)$this->_aVars['aMenus'])):  foreach ((array) $this->_aVars['aMenus'] as $this->_aVars['sType'] => $this->_aVars['aMenusSub']): ?>
	<tr>
		<td colspan="5" class="table_header2">
<?php echo $this->_aVars['sType']; ?>
		</td>
	</tr>
	<tr>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.order'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.menu'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.location'); ?></th>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.active'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.actions'); ?></th>
	</tr>	
<?php if (count((array)$this->_aVars['aMenusSub'])):  foreach ((array) $this->_aVars['aMenusSub'] as $this->_aVars['iKey'] => $this->_aVars['aMenu']): ?>
	<?php /* Cached: January 28, 2013, 9:05 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: entry.html.php 1300 2009-12-07 00:39:10Z Raymond_Benc $
 */
 
 

?><tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
	<td class="t_center"><input type="text" name="val[<?php echo $this->_aVars['aMenu']['menu_id']; ?>][ordering]" value="<?php echo $this->_aVars['aMenu']['ordering']; ?>" size="3" class="t_center" /></td>
	<td><?php echo $this->_aVars['aMenu']['name']; ?></td>
	<td><?php echo $this->_aVars['aMenu']['url_value']; ?></td>
	<td class="t_center"><input type="checkbox" name="val[<?php echo $this->_aVars['aMenu']['menu_id']; ?>][is_active]" value="1" <?php if ($this->_aVars['aMenu']['is_active']): ?>checked="checked" <?php endif; ?>/></td>
	<td>
		<select name="action" class="goJump" style="width:140px;">
			<option value=""><?php echo Phpfox::getPhrase('language.select_action'); ?></option>		
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu.add.', array('id' => $this->_aVars['aMenu']['menu_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></option>
<?php if ($this->_aVars['aMenu']['total_children'] > 0): ?>
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu', array('parent' => $this->_aVars['aMenu']['menu_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.manage_children_total_children', array('total_children' => $this->_aVars['aMenu']['total_children'])); ?></option>
<?php endif; ?>
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu.', array('delete' => $this->_aVars['aMenu']['menu_id'])); ?>" style="color:red;"><?php echo Phpfox::getPhrase('admincp.delete'); ?></option>
		</select>
	</td>
</tr>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
<?php endif; ?>
	<tr>
		<td colspan="5" class="table_header">
<?php if ($this->_aVars['iParentId'] === 0): ?>
<?php echo Phpfox::getPhrase('admincp.modules'); ?>
<?php else: ?>
			Children: <?php echo Phpfox::getPhrase(''.$this->_aVars['aParentMenu']['module_id'].'.'.$this->_aVars['aParentMenu']['var_name'].''); ?>
<?php endif; ?>
		</td>
	</tr>
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['sModule'] => $this->_aVars['aMenusSub']): ?>
<?php if ($this->_aVars['iParentId'] === 0): ?>
	<tr>
		<td colspan="5" class="table_header2">
<?php echo $this->_aVars['sModule']; ?>
		</td>
	</tr>
<?php endif; ?>
	<tr>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.order'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.menu'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.location'); ?></th>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.active'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.actions'); ?></th>
	</tr>	
<?php if (count((array)$this->_aVars['aMenusSub'])):  foreach ((array) $this->_aVars['aMenusSub'] as $this->_aVars['iKey'] => $this->_aVars['aMenu']): ?>
	<?php /* Cached: January 28, 2013, 9:05 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: entry.html.php 1300 2009-12-07 00:39:10Z Raymond_Benc $
 */
 
 

?><tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif; ?>">
	<td class="t_center"><input type="text" name="val[<?php echo $this->_aVars['aMenu']['menu_id']; ?>][ordering]" value="<?php echo $this->_aVars['aMenu']['ordering']; ?>" size="3" class="t_center" /></td>
	<td><?php echo $this->_aVars['aMenu']['name']; ?></td>
	<td><?php echo $this->_aVars['aMenu']['url_value']; ?></td>
	<td class="t_center"><input type="checkbox" name="val[<?php echo $this->_aVars['aMenu']['menu_id']; ?>][is_active]" value="1" <?php if ($this->_aVars['aMenu']['is_active']): ?>checked="checked" <?php endif; ?>/></td>
	<td>
		<select name="action" class="goJump" style="width:140px;">
			<option value=""><?php echo Phpfox::getPhrase('language.select_action'); ?></option>		
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu.add.', array('id' => $this->_aVars['aMenu']['menu_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></option>
<?php if ($this->_aVars['aMenu']['total_children'] > 0): ?>
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu', array('parent' => $this->_aVars['aMenu']['menu_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.manage_children_total_children', array('total_children' => $this->_aVars['aMenu']['total_children'])); ?></option>
<?php endif; ?>
			<option value="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.menu.', array('delete' => $this->_aVars['aMenu']['menu_id'])); ?>" style="color:red;"><?php echo Phpfox::getPhrase('admincp.delete'); ?></option>
		</select>
	</td>
</tr>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
	</table>
	<div class="table_bottom table_hover_action">
		<input type="submit" value="<?php echo Phpfox::getPhrase('admincp.update'); ?>" class="button" />
	</div>

</form>


