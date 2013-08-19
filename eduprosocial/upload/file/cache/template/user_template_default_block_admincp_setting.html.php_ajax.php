<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:09 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: setting.html.php 4074 2012-03-28 14:02:40Z Raymond_Benc $
 */
 
 

?>
<?php if (count((array)$this->_aVars['aSettings'])):  foreach ((array) $this->_aVars['aSettings'] as $this->_aVars['aProduct']): ?>
<?php if (count((array)$this->_aVars['aProduct'])):  foreach ((array) $this->_aVars['aProduct'] as $this->_aVars['sKey'] => $this->_aVars['aSetting']): ?>
<?php if (count((array)$this->_aVars['aSetting'])):  $this->_aPhpfoxVars['iteration']['settings'] = 0;  foreach ((array) $this->_aVars['aSetting'] as $this->_aVars['aItem']):  $this->_aPhpfoxVars['iteration']['settings']++; ?>

			<a name="setting<?php echo $this->_aVars['aItem']['setting_id']; ?>"></a>
			<div class="<?php if (is_int ( $this->_aPhpfoxVars['iteration']['settings'] / 2 )): ?>table1<?php else: ?>table2<?php endif;  if ($this->_aVars['aItem']['is_admin_setting']): ?> is_admin_setting<?php endif; ?>">
				<div class="table_left2">				
<?php if (PHPFOX_DEBUG): ?>
				<div class="p_4">
					<input type="text" name="val[order][<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="<?php echo $this->_aVars['aItem']['ordering']; ?>" style="font-size:9pt; padding:0px; text-align:center;" onclick="this.select();" size="2" /> 
					<input type="text" name="param[<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="<?php echo $this->_aVars['sKey']; ?>.<?php echo $this->_aVars['aItem']['name']; ?>" style="font-size:9pt; padding:0px;" onclick="this.select();" />
					- <a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl("admincp.user.group.setting", array('id' => "".$this->_aVars['aItem']['setting_id']."",'gid' => "".$this->_aVars['aForms']['user_group_id']."")); ?>"><?php echo Phpfox::getPhrase('user.edit'); ?></a>
				</div>
<?php endif; ?>
<?php echo $this->_aVars['aItem']['setting_name']; ?>
				</div>
				<div class="table_right2">				    
<?php if (in_array ( $this->_aVars['aItem']['name'] , $this->_aVars['aCurrency'] ) == true || isset ( $this->_aVars['aItem']['isCurrency'] )): ?>
					    <input type="hidden" name="val[sponsor_setting_id_<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="<?php echo $this->_aVars['aItem']['setting_id']; ?>" />
<?php Phpfox::getBlock('core.currency', array('currency_field_name' => 'val[value_actual]['.$this->_aVars['aItem']['setting_id'].']')); ?>
<?php elseif ($this->_aVars['aItem']['type_id'] == 'big_string'): ?>
					<textarea cols="60" rows="8" name="val[value_actual][<?php echo $this->_aVars['aItem']['setting_id']; ?>]"><?php echo $this->_aVars['aItem']['value_actual']; ?></textarea>
<?php elseif (( $this->_aVars['aItem']['type_id'] == 'integer' || $this->_aVars['aItem']['type_id'] == 'string' )): ?>
					<input type="text" name="val[value_actual][<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="<?php echo $this->_aVars['aItem']['value_actual']; ?>" size="25" onclick="this.select();" />		
<?php elseif (( $this->_aVars['aItem']['type_id'] == 'boolean' )): ?>
					<div class="item_is_active_holder">		
						<span class="js_item_active item_is_active"><input type="radio" name="val[value_actual][<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="1" <?php if ($this->_aVars['aItem']['value_actual']): ?>checked="checked" <?php endif; ?>/> <?php echo Phpfox::getPhrase('user.yes'); ?></span>
						<span class="js_item_active item_is_not_active"><input type="radio" name="val[value_actual][<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="0" <?php if (! $this->_aVars['aItem']['value_actual']): ?>checked="checked" <?php endif; ?>/> <?php echo Phpfox::getPhrase('user.no'); ?></span>
					</div>
<?php elseif (( $this->_aVars['aItem']['type_id'] == 'array' )): ?>
						<input type="text" name="val[value_actual][<?php echo $this->_aVars['aItem']['setting_id']; ?>]" value="<?php if (count((array)$this->_aVars['aItem']['value_actual'])):  $this->_aPhpfoxVars['iteration']['arraysetting'] = 0;  foreach ((array) $this->_aVars['aItem']['value_actual'] as $this->_aVars['aValueActual']):  $this->_aPhpfoxVars['iteration']['arraysetting']++;  if ($this->_aPhpfoxVars['iteration']['arraysetting'] != 1): ?>,<?php endif;  echo $this->_aVars['aValueActual'];  endforeach; endif; ?>" />
<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>	
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
<?php endforeach; endif; ?>
