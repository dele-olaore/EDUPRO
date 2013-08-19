<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:38 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: add.html.php 1179 2009-10-12 13:56:40Z Raymond_Benc $
 */
 
 

?>
<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.rss.group.add'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>';  if ($this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['group_id']; ?>" /></div>
<?php endif; ?>
	<div class="table_header">
<?php echo Phpfox::getPhrase('rss.group_details'); ?>
	</div>
<?php if (! $this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('admincp.product.form', array()); ?>
<?php Phpfox::getBlock('admincp.module.form', array()); ?>
<?php endif; ?>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('rss.name'); ?>:
		</div>
		<div class="table_right">
<?php if ($this->_aVars['bIsEdit']): ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'text','id' => 'name_var','var_name' => $this->_aVars['aForms']['name_var'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('language.admincp.form', array('type' => 'text','id' => 'name_var')); ?>
<?php endif; ?>
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

