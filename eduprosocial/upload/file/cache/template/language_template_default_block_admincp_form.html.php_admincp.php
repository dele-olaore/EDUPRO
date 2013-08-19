<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:38 am */ ?>
<?php
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: form.html.php 2655 2011-06-03 11:40:56Z Miguel_Espinoza $
 */
 
 

 if (count((array)$this->_aVars['aLanguages'])):  foreach ((array) $this->_aVars['aLanguages'] as $this->_aVars['aLanguage']):  if ($this->_aVars['sType'] == 'text'): ?>
	<div style="padding-bottom:5px;">	
		<input type="text" name="val[<?php echo $this->_aVars['sId']; ?>]<?php if (isset ( $this->_aVars['aLanguage']['phrase_var_name'] )): ?>[<?php echo $this->_aVars['aLanguage']['phrase_var_name']; ?>]<?php endif; ?>[<?php echo $this->_aVars['aLanguage']['language_id']; ?>]<?php if (isset ( $this->_aVars['sMode'] )): ?>[<?php echo $this->_aVars['sMode']; ?>]<?php endif; ?>" value="<?php echo Phpfox::getLib('parse.output')->htmlspecialchars($this->_aVars['aLanguage']['post_value']); ?>" /> <?php echo $this->_aVars['aLanguage']['title']; ?>
	</div>
<?php elseif ($this->_aVars['sType'] == 'label'): ?>
<?php if ($this->_aVars['aLanguage']['post_value'] != ''): ?>
		<div class="p_4">
<?php echo Phpfox::getLib('parse.output')->htmlspecialchars($this->_aVars['aLanguage']['post_value']); ?> <small>(<?php echo $this->_aVars['aLanguage']['title']; ?>)</small>
		</div>
<?php endif;  else: ?>
<?php echo $this->_aVars['aLanguage']['title']; ?>
	<div class="p_4">
		<textarea cols="50" rows="5" name="val[<?php echo $this->_aVars['sId']; ?>]<?php if (isset ( $this->_aVars['aLanguage']['phrase_var_name'] )): ?>[<?php echo $this->_aVars['aLanguage']['phrase_var_name']; ?>]<?php endif; ?>[<?php echo $this->_aVars['aLanguage']['language_id']; ?>]<?php if (isset ( $this->_aVars['sMode'] )): ?>[<?php echo $this->_aVars['sMode']; ?>]<?php endif; ?>"><?php echo Phpfox::getLib('parse.output')->htmlspecialchars($this->_aVars['aLanguage']['post_value']); ?></textarea>
	</div>
<?php endif;  endforeach; endif; ?>
