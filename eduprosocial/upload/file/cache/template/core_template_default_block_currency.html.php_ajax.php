<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:09 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: currency.html.php 1883 2010-10-05 08:43:21Z Miguel_Espinoza $
 */
 
 

 if (count((array)$this->_aVars['aCurrencies'])):  foreach ((array) $this->_aVars['aCurrencies'] as $this->_aVars['sName'] => $this->_aVars['aCurrency']): ?>
<div class="p_4">
<?php echo $this->_aVars['aCurrency']['symbol']; ?> <input type="text" name="<?php echo $this->_aVars['sCurrencyFieldName']; ?>[<?php echo $this->_aVars['sName']; ?>]" value="<?php if (isset ( $this->_aVars['aCurrency']['value'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aCurrency']['value']);  else: ?>0<?php endif; ?>" size="10" /> <?php echo Phpfox::getPhrase($this->_aVars['aCurrency']['name']); ?>
</div>
<?php endforeach; endif; ?>
