<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:40 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: index.html.php 1300 2009-12-07 00:39:10Z Raymond_Benc $
 */
 
 

?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="4" class="table_header"><?php echo Phpfox::getPhrase('admincp.core_modules'); ?></td>
	</tr>
	<tr>
		<th style="width:20px;"></th>
		<th><?php echo Phpfox::getPhrase('admincp.name'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.product'); ?></th>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.active'); ?></th>
	</tr>	
<?php if (count((array)$this->_aVars['aModules']['core'])):  foreach ((array) $this->_aVars['aModules']['core'] as $this->_aVars['iKey'] => $this->_aVars['aModule']): ?>
	<?php /* Cached: May 28, 2013, 11:40 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: entry.html.php 4939 2012-10-23 09:17:04Z Miguel_Espinoza $
 */
 
 

?>
<script type="text/javascript">
	var sInProcess = '';
	function checkInProcess(sModuleId)
	{
		if (sInProcess == '')
		{
			sInProcess = sModuleId;
			return true;
		}
		return false;
	}
</script>
<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif;  if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?> is_checked<?php endif; ?>">
	<td class="t_center">
<?php if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?>
		<a onclick="return checkInProcess('<?php echo $this->_aVars['aModule']['module_id']; ?>');" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module', array('install' => $this->_aVars['aModule']['module_id'])); ?>" title="<?php echo Phpfox::getPhrase('admincp.install_this_module'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_add.png')); ?></a>
<?php else: ?>
		<a href="#" class="js_drop_down_link" title="<?php echo Phpfox::getPhrase('admincp.manage'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
		<div class="link_menu">
			<ul>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module.add.', array('id' => $this->_aVars['aModule']['module_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></a></li>
<?php if (isset ( $this->_aVars['aModule']['total_setting'] ) && $this->_aVars['aModule']['total_setting'] > 0): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.setting.edit', array('module-id' => $this->_aVars['aModule']['module_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.manage_settings'); ?></a></li>
<?php endif; ?>
<?php if (! $this->_aVars['aModule']['is_core']): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module', array('delete' => $this->_aVars['aModule']['module_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('admincp.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('admincp.uninstall'); ?></a></li>					
<?php endif; ?>
			</ul>
		</div>		
<?php endif; ?>
	</td>
	<td><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['aModule']['module_id'], 'module'); ?></td>
	<td><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['aModule']['product_title'], 'product'); ?></td>
	<td class="t_center">
<?php if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?>
<?php else: ?>
<?php if ($this->_aVars['aModule']['is_core']): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?>
<?php else: ?>
		<div class="js_item_is_active"<?php if (! $this->_aVars['aModule']['is_active']): ?> style="display:none;"<?php endif; ?>>
			<a href="#?call=admincp.updateModuleActivity&amp;id=<?php echo $this->_aVars['aModule']['module_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
		</div>
		<div class="js_item_is_not_active"<?php if ($this->_aVars['aModule']['is_active']): ?> style="display:none;"<?php endif; ?>>
			<a href="#?call=admincp.updateModuleActivity&amp;id=<?php echo $this->_aVars['aModule']['module_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
		</div>		
<?php endif; ?>
<?php endif; ?>
	</td>
</tr>
<?php endforeach; endif; ?>
	<tr>
		<td colspan="4" class="table_header"><?php echo Phpfox::getPhrase('admincp.modules'); ?></td>
	</tr>
	<tr>
		<th style="width:20px;"></th>
		<th><?php echo Phpfox::getPhrase('admincp.name'); ?></th>
		<th><?php echo Phpfox::getPhrase('admincp.product'); ?></th>
		<th style="width:60px;"><?php echo Phpfox::getPhrase('admincp.active'); ?></th>		
	</tr>	
<?php if (count((array)$this->_aVars['aModules']['3rdparty'])):  foreach ((array) $this->_aVars['aModules']['3rdparty'] as $this->_aVars['iKey'] => $this->_aVars['aModule']): ?>
	<?php /* Cached: May 28, 2013, 11:40 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: entry.html.php 4939 2012-10-23 09:17:04Z Miguel_Espinoza $
 */
 
 

?>
<script type="text/javascript">
	var sInProcess = '';
	function checkInProcess(sModuleId)
	{
		if (sInProcess == '')
		{
			sInProcess = sModuleId;
			return true;
		}
		return false;
	}
</script>
<tr class="checkRow<?php if (is_int ( $this->_aVars['iKey'] / 2 )): ?> tr<?php else:  endif;  if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?> is_checked<?php endif; ?>">
	<td class="t_center">
<?php if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?>
		<a onclick="return checkInProcess('<?php echo $this->_aVars['aModule']['module_id']; ?>');" href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module', array('install' => $this->_aVars['aModule']['module_id'])); ?>" title="<?php echo Phpfox::getPhrase('admincp.install_this_module'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_add.png')); ?></a>
<?php else: ?>
		<a href="#" class="js_drop_down_link" title="<?php echo Phpfox::getPhrase('admincp.manage'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_arrow_down.png','alt' => '')); ?></a>
		<div class="link_menu">
			<ul>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module.add.', array('id' => $this->_aVars['aModule']['module_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.edit'); ?></a></li>
<?php if (isset ( $this->_aVars['aModule']['total_setting'] ) && $this->_aVars['aModule']['total_setting'] > 0): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.setting.edit', array('module-id' => $this->_aVars['aModule']['module_id'])); ?>"><?php echo Phpfox::getPhrase('admincp.manage_settings'); ?></a></li>
<?php endif; ?>
<?php if (! $this->_aVars['aModule']['is_core']): ?>
				<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.module', array('delete' => $this->_aVars['aModule']['module_id'])); ?>" onclick="return confirm('<?php echo Phpfox::getPhrase('admincp.are_you_sure', array('phpfox_squote' => true)); ?>');"><?php echo Phpfox::getPhrase('admincp.uninstall'); ?></a></li>					
<?php endif; ?>
			</ul>
		</div>		
<?php endif; ?>
	</td>
	<td><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['aModule']['module_id'], 'module'); ?></td>
	<td><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['aModule']['product_title'], 'product'); ?></td>
	<td class="t_center">
<?php if (isset ( $this->_aVars['aModule']['is_not_installed'] )): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?>
<?php else: ?>
<?php if ($this->_aVars['aModule']['is_core']): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?>
<?php else: ?>
		<div class="js_item_is_active"<?php if (! $this->_aVars['aModule']['is_active']): ?> style="display:none;"<?php endif; ?>>
			<a href="#?call=admincp.updateModuleActivity&amp;id=<?php echo $this->_aVars['aModule']['module_id']; ?>&amp;active=0" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.deactivate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_green.png','alt' => '')); ?></a>
		</div>
		<div class="js_item_is_not_active"<?php if ($this->_aVars['aModule']['is_active']): ?> style="display:none;"<?php endif; ?>>
			<a href="#?call=admincp.updateModuleActivity&amp;id=<?php echo $this->_aVars['aModule']['module_id']; ?>&amp;active=1" class="js_item_active_link" title="<?php echo Phpfox::getPhrase('admincp.activate'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/bullet_red.png','alt' => '')); ?></a>
		</div>		
<?php endif; ?>
<?php endif; ?>
	</td>
</tr>
<?php endforeach; endif; ?>
	</table>
	<div class="table_clear"></div>
