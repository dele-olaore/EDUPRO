<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:40 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Admincp
 * @version 		$Id: add.html.php 1299 2009-12-06 18:06:19Z Raymond_Benc $
 */
 
 

 echo '
<script type="text/javascript">
<!--
function changeFormValue(sValue)
{
	switch(sValue)
	{
		'; ?>

		case 'boolean':
			sHtml = '<select name="val[value]" id="value"><option value="1" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('value') && in_array('value', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['value'])
								&& $aParams['value'] == '1')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['value'])
									&& !isset($aParams['value'])
									&& $this->_aVars['aForms']['value'] == '1')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.true', array('phpfox_squote' => true)); ?></option><option value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('value') && in_array('value', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['value'])
								&& $aParams['value'] == '0')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['value'])
									&& !isset($aParams['value'])
									&& $this->_aVars['aForms']['value'] == '0')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.false', array('phpfox_squote' => true)); ?></option></select>';
			sClass = 'table_right';
			break;
		case 'password':
			sHtml = '<input type="password" name="val[value]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
" size="40" id="value" />';			
			sClass = 'table_right';		
			break;
		case 'array':
			sHtml = '<textarea cols="50" rows="8" name="val[value]" id="value"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
</textarea>';
			sHtml += '<div class="p_4"><?php echo Phpfox::getPhrase('admincp.setting_array_example', array('phpfox_squote' => true)); ?></div>';
			sClass = 'table_right_text';	
			break;	
		case 'drop':
			sHtml = '<textarea cols="50" rows="8" name="val[value]" id="value"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
</textarea>';
			sHtml += '<div class="p_4"><?php echo Phpfox::getPhrase('admincp.setting_drop_down_example', array('phpfox_squote' => true)); ?></div>';
			sClass = 'table_right_text';	
			break;	
<?php (($sPlugin = Phpfox_Plugin::get('admincp.template_controller_setting_add_js_form_value')) ? eval($sPlugin) : false); ?>
		case 'large_string':
			sHtml = '<textarea cols="50" rows="8" name="val[value]" id="value"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
</textarea>';
			sClass = 'table_right_text';
			break;
		default:
			sHtml = '<input type="text" name="val[value]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
" size="40" id="value" />';			
			sClass = 'table_right';			
			break;		
		<?php echo '
	}
	$(\'#js_form_value_class\').removeClass(\'table_right\');
	$(\'#js_form_value_class\').removeClass(\'table_right_text\');
	$(\'#js_form_value_class\').addClass(sClass);
	$(\'#js_form_value\').html(sHtml);
}
-->
</script>
'; ?>

<?php echo $this->_aVars['sCreateJs']; ?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("admincp.setting.add"); ?>" id="js_setting_form" onsubmit="<?php echo $this->_aVars['sGetJsForm']; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['bEdit']): ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['setting_id']; ?>" /></div>
	<div><input type="hidden" name="val[var_name]" value="<?php echo $this->_aVars['aForms']['var_name']; ?>" /></div>
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.setting_details'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.product'); ?>:
		</div>
		<div class="table_right">
			<select name="val[product_id]">
<?php if (count((array)$this->_aVars['aProducts'])):  foreach ((array) $this->_aVars['aProducts'] as $this->_aVars['aProduct']): ?>
				<option value="<?php echo $this->_aVars['aProduct']['product_id']; ?>"><?php echo $this->_aVars['aProduct']['title']; ?></option>
<?php endforeach; endif; ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_product')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.module'); ?>:
		</div>
		<div class="table_right">
			<select name="val[module_id]">
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['sModule'] => $this->_aVars['iModuleId']): ?>
					<option value="<?php echo $this->_aVars['iModuleId']; ?>" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('module_id') && in_array('module_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['module_id'])
								&& $aParams['module_id'] == $this->_aVars['iModuleId'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['module_id'])
									&& !isset($aParams['module_id'])
									&& $this->_aVars['aForms']['module_id'] == $this->_aVars['iModuleId'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo $this->_aVars['sModule']; ?></option>
<?php endforeach; endif; ?>
			</select>		
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_module_id')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.group'); ?>:
		</div>
		<div class="table_right">
			<select name="val[group_id]">
				<option value=""><?php echo Phpfox::getPhrase('admincp.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aGroups'])):  foreach ((array) $this->_aVars['aGroups'] as $this->_aVars['aGroup']): ?>
					<option value="<?php echo $this->_aVars['aGroup']['group_id']; ?>" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('group_id') && in_array('group_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['group_id'])
								&& $aParams['group_id'] == $this->_aVars['aGroup']['group_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['group_id'])
									&& !isset($aParams['group_id'])
									&& $this->_aVars['aForms']['group_id'] == $this->_aVars['aGroup']['group_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo $this->_aVars['aGroup']['var_name']; ?></option>
<?php endforeach; endif; ?>
			</select>	
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_group')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.variable'); ?>:
		</div>
		<div class="table_right">
<?php if ($this->_aVars['bEdit']): ?>
<?php echo $this->_aVars['aForms']['var_name']; ?>
<?php else: ?>
			<input type="text" name="val[var_name]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['var_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['var_name']) : (isset($this->_aVars['aForms']['var_name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['var_name']) : '')); ?>
" size="40" id="var_name" maxlength="100" />
<?php endif; ?>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_var')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.type'); ?>:
		</div>
		<div class="table_right">
			<select id="js_form_value_actual" name="val[type]" onchange="changeFormValue(this.value);">
				<option value="string" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'string')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'string')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.string'); ?></option>
				<option value="large_string" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'large_string')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'large_string')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.large_string'); ?></option>
				<option value="password" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'password')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'password')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.password'); ?></option>
				<option value="boolean" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'boolean')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'boolean')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.boolean'); ?></option>
				<option value="integer" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'integer')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'integer')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.integer'); ?></option>
				<option value="array" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'array')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'array')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.array'); ?></option>
				<option value="drop" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('type') && in_array('type', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['type'])
								&& $aParams['type'] == 'drop')

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['type'])
									&& !isset($aParams['type'])
									&& $this->_aVars['aForms']['type'] == 'drop')
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getPhrase('admincp.defined_drop_down'); ?></option>
<?php (($sPlugin = Phpfox_Plugin::get('admincp.template_controller_setting_add_type_drop_down')) ? eval($sPlugin) : false); ?>
			</select>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_type')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.value'); ?>:
		</div>
		<div id="js_form_value_class" class="table_right_text">
			<div id="js_form_value">
				<textarea cols="60" rows="8" name="val[value]" id="value"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['value']) : (isset($this->_aVars['aForms']['value']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['value']) : '')); ?>
</textarea>			
			</div>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_value')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.language_package_details'); ?>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.title'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="40" id="title" maxlength="250" />
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_title')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('admincp.info'); ?>:
		</div>
		<div class="table_right_text">
			<textarea cols="50" rows="8" name="val[info]" id="info"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['info']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['info']) : (isset($this->_aVars['aForms']['info']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['info']) : '')); ?>
</textarea>
<?php Phpfox::getBlock('help.popup', array('phrase' => 'admincp.setting_add_info')); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('admincp.submit'); ?>" class="button" />
	</div>

</form>

<script type="text/javascript">
<!--
	var oSelected = document.getElementById('js_form_value_actual');	
	changeFormValue(oSelected.options[oSelected.selectedIndex].value);
-->
</script>
