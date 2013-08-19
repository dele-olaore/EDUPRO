<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:09 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: add.html.php 3534 2011-11-21 14:22:06Z Raymond_Benc $
 */
 
 

 if (! isset ( $this->_aVars['aForms'] )): ?>
<div class="table_header">
<?php echo Phpfox::getPhrase('user.user_group_details'); ?>
</div>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add'); ?>" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<?php /* Cached: May 28, 2013, 1:09 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: entry.html.php 1247 2009-11-03 16:08:56Z Raymond_Benc $
 */
 
 

?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.name'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="40" maxlength="100" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.html_prefix'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[prefix]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['prefix']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['prefix']) : (isset($this->_aVars['aForms']['prefix']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['prefix']) : '')); ?>
" size="20" maxlength="75" />
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.html_suffix'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[suffix]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['suffix']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['suffix']) : (isset($this->_aVars['aForms']['suffix']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['suffix']) : '')); ?>
" size="20" maxlength="75" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.icon'); ?>:
		</div>
		<div class="table_right">
<?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?>
			<div id="js_group_icon">
				<div class="p_2">
					<img src="<?php echo Phpfox::getParam('core.url_icon');  echo $this->_aVars['aForms']['icon_ext']; ?>" alt="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']); ?>" />
				</div>
				<div class="p_4">
					<a href="#" onclick="$('#js_group_upload_icon').show(); $('#js_group_icon').hide(); return false;">Change Icon</a>
				</div>
			</div>
<?php endif; ?>
			<div id="js_group_upload_icon"<?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?> style="display:none;"<?php endif; ?>>
				<input type="file" name="icon" size="30" /><?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?> - <a href="#" onclick="$('#js_group_upload_icon').hide(); $('#js_group_icon').show(); return false;"><?php echo Phpfox::getPhrase('user.cancel'); ?></a><?php endif; ?>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('user.you_can_upload_a_jpg_gif_or_png_file'); ?>
					<br />
<?php echo Phpfox::getPhrase('user.the_advised_width_height_is_20_pixels'); ?>
				</div>			
			</div>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.inherit'); ?>
		</div>
		<div class="table_right">
			<select name="val[inherit_id]">
<?php if (count((array)$this->_aVars['aGroups'])):  foreach ((array) $this->_aVars['aGroups'] as $this->_aVars['iKey'] => $this->_aVars['aGroup']): ?>
				<option value="<?php echo $this->_aVars['aGroup']['user_group_id']; ?>" <?php if ($this->_aVars['aGroup']['user_group_id'] == 2): ?> selected="selected"<?php endif; ?>><?php echo $this->_aVars['aGroup']['title']; ?></option>
<?php endforeach; endif; ?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('user.add_user_group'); ?>" class="button" />
	</div>

</form>

<?php else:  if ($this->_aVars['aForms']['user_group_id'] == GUEST_USER_ID): ?>
<?php Phpfox::getBlock('help.info', array('phrase' => 'admincp.not_allowed_for_guests'));  endif;  if (! $this->_aVars['bEditSettings']): ?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.user.group.add'); ?>" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['user_group_id']; ?>" /></div>	
	<div class="table_header">
<?php echo Phpfox::getPhrase('user.user_group_details'); ?>
	</div>
	<?php /* Cached: May 28, 2013, 1:09 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: entry.html.php 1247 2009-11-03 16:08:56Z Raymond_Benc $
 */
 
 

?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('user.name'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="40" maxlength="100" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.html_prefix'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[prefix]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['prefix']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['prefix']) : (isset($this->_aVars['aForms']['prefix']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['prefix']) : '')); ?>
" size="20" maxlength="75" />
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.html_suffix'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[suffix]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['suffix']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['suffix']) : (isset($this->_aVars['aForms']['suffix']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['suffix']) : '')); ?>
" size="20" maxlength="75" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('user.icon'); ?>:
		</div>
		<div class="table_right">
<?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?>
			<div id="js_group_icon">
				<div class="p_2">
					<img src="<?php echo Phpfox::getParam('core.url_icon');  echo $this->_aVars['aForms']['icon_ext']; ?>" alt="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']); ?>" />
				</div>
				<div class="p_4">
					<a href="#" onclick="$('#js_group_upload_icon').show(); $('#js_group_icon').hide(); return false;">Change Icon</a>
				</div>
			</div>
<?php endif; ?>
			<div id="js_group_upload_icon"<?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?> style="display:none;"<?php endif; ?>>
				<input type="file" name="icon" size="30" /><?php if (! empty ( $this->_aVars['aForms']['icon_ext'] )): ?> - <a href="#" onclick="$('#js_group_upload_icon').hide(); $('#js_group_icon').show(); return false;"><?php echo Phpfox::getPhrase('user.cancel'); ?></a><?php endif; ?>
				<div class="extra_info">
<?php echo Phpfox::getPhrase('user.you_can_upload_a_jpg_gif_or_png_file'); ?>
					<br />
<?php echo Phpfox::getPhrase('user.the_advised_width_height_is_20_pixels'); ?>
				</div>			
			</div>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('core.submit'); ?>" class="button" />
	</div>

</form>

<?php else: ?>
<form method="post" action="#" onsubmit="$Core.ajaxMessage(); $(this).ajaxCall('user.updateSettings'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['user_group_id']; ?>" /></div>	
	<div class="table_header">
<?php echo Phpfox::getPhrase('user.module_settings'); ?>
	</div>	
	<div id="content_editor_holder">
		<div id="content_editor_menu">
			<ul>
<?php if (count((array)$this->_aVars['aModules'])):  foreach ((array) $this->_aVars['aModules'] as $this->_aVars['aModule']): ?>
				<li><a href="#" onclick="$.ajaxCall('user.getSettings', 'group_id=<?php echo $this->_aVars['aForms']['user_group_id']; ?>&amp;module_id=<?php echo $this->_aVars['aModule']['module_id']; ?>', 'GET'); $(this).blur(); $('#content_editor_menu a').removeClass('cem_active'); $(this).addClass('cem_active'); return false;"><?php echo Phpfox::getLib('phpfox.locale')->translate($this->_aVars['aModule']['module_id'], 'module'); ?></a></li>
<?php endforeach; endif; ?>
			</ul>
		</div>
		<div id="content_editor_text" style="display:none;">
			<div class="table_header2" id="js_module_title"></div>
			<div id="js_setting_block" style="position:relative;"></div>			
			<div class="table_clear table_hover_action_custom">
				<span id="js_setting_saved"></span> <input type="submit" value="<?php echo Phpfox::getPhrase('user.save'); ?>" class="button" />
			</div>			
		</div>
		<div class="clear"></div>
	</div>

</form>
	
<?php endif;  endif; ?>
