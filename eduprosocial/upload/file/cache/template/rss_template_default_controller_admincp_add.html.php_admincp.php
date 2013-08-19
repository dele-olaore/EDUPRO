<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:38 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: add.html.php 1224 2009-10-27 19:03:46Z Raymond_Benc $
 */
 
 

?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.rss.add'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>';  if ($this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['feed_id']; ?>" /></div>
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('rss.feed_details'); ?>
	</div>
<?php if (! $this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('admincp.product.form', array()); ?>
<?php Phpfox::getBlock('admincp.module.form', array()); ?>
<?php endif; ?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.group'); ?>:
		</div>
		<div class="table_right">
			<select name="val[group_id]">
				<option value=""><?php echo Phpfox::getPhrase('rss.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aGroups'])):  foreach ((array) $this->_aVars['aGroups'] as $this->_aVars['aGroup']): ?>
				<option value="<?php echo $this->_aVars['aGroup']['group_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


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
><?php echo Phpfox::getPhrase($this->_aVars['aGroup']['name_var']); ?></option>
<?php endforeach; endif; ?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.title'); ?>:
		</div>
		<div class="table_right">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'text','id' => 'title_var','var_name' => $this->_aVars['aForms']['title_var'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'text','id' => 'title_var')); ?>
<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.description'); ?>:
		</div>
		<div class="table_right">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'textarea','id' => 'description_var','var_name' => $this->_aVars['aForms']['description_var'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'textarea','id' => 'description_var')); ?>
<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.link'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[feed_link]" id="feed_link" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['feed_link']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['feed_link']) : (isset($this->_aVars['aForms']['feed_link']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['feed_link']) : '')); ?>
" size="40" />
		</div>
		<div class="clear"></div>
	</div>		
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('rss.php_group_code'); ?>:
		</div>
		<div class="table_right">
			<textarea cols="60" rows="15" name="val[php_group_code]" id="php_group_code" style="width:99%;"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['php_group_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['php_group_code']) : (isset($this->_aVars['aForms']['php_group_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['php_group_code']) : '')); ?>
</textarea>
		</div>
		<div class="clear"></div>
	</div>		
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.php_view_code'); ?>:
		</div>
		<div class="table_right">
			<textarea cols="60" rows="15" name="val[php_view_code]" id="php_view_code" style="width:99%;"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['php_view_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['php_view_code']) : (isset($this->_aVars['aForms']['php_view_code']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['php_view_code']) : '')); ?>
</textarea>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.site_wide'); ?>:
		</div>
		<div class="table_right">	
			<div class="item_is_active_holder">		
				<span class="js_item_active item_is_active"><input type="radio" name="val[is_site_wide]" value="1" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_site_wide') && in_array('is_site_wide', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_site_wide']) && $aParams['is_site_wide'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_site_wide']) && !isset($aParams['is_site_wide']) && $this->_aVars['aForms']['is_site_wide'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('rss.yes'); ?></span>
				<span class="js_item_active item_is_not_active"><input type="radio" name="val[is_site_wide]" value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_site_wide') && in_array('is_site_wide', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_site_wide']) && $aParams['is_site_wide'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_site_wide']) && !isset($aParams['is_site_wide']) && $this->_aVars['aForms']['is_site_wide'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_site_wide']) && !isset($aParams['is_site_wide']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('rss.no'); ?></span>
			</div>
		</div>
		<div class="clear"></div>		
	</div>		
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.is_active'); ?>:
		</div>
		<div class="table_right">	
			<div class="item_is_active_holder">		
				<span class="js_item_active item_is_active"><input type="radio" name="val[is_active]" value="1" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('rss.yes'); ?></span>
				<span class="js_item_active item_is_not_active"><input type="radio" name="val[is_active]" value="0" <?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('is_active') && in_array('is_active', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['is_active']) && $aParams['is_active'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['is_active']) && !isset($aParams['is_active']) && $this->_aVars['aForms']['is_active'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('rss.no'); ?></span>
			</div>
		</div>
		<div class="clear"></div>		
	</div>		
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('rss.submit'); ?>" class="button" />
	</div>

</form>

