<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:42 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: counter.html.php 1335 2009-12-17 14:47:04Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['bRefresh']): ?>
<div class="message">
<?php echo Phpfox::getPhrase('admincp.updating_counters_processing_page_current_out_of_page', array('current' => $this->_aVars['iCurrentPage'],'page' => $this->_aVars['iTotalPages'])); ?>
</div>
<?php else: ?>
<div class="table_header">
<?php echo Phpfox::getPhrase('admincp.counters'); ?>
</div>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo Phpfox::getPhrase('admincp.type'); ?></th>
		<th class="t_center"><?php echo Phpfox::getPhrase('admincp.actions'); ?></th>
	</tr>
<?php if (count((array)$this->_aVars['aLists'])):  foreach ((array) $this->_aVars['aLists'] as $this->_aVars['sModule'] => $this->_aVars['aSubLists']): ?>
<?php if (count((array)$this->_aVars['aSubLists'])):  $this->_aPhpfoxVars['iteration']['counters'] = 0;  foreach ((array) $this->_aVars['aSubLists'] as $this->_aVars['aList']):  $this->_aPhpfoxVars['iteration']['counters']++; ?>

	<tr class="checkRow<?php if (is_int ( $this->_aVars['aList']['count'] / 2 )):  else: ?> tr<?php endif; ?>">
		<td>
<?php echo $this->_aVars['aList']['name']; ?>
		</td>
		<td class="t_center"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('admincp.maintain.counter', array('module' => $this->_aVars['sModule'],'id' => $this->_aVars['aList']['id'])); ?>"><?php echo Phpfox::getPhrase('admincp.update'); ?></a></td>
	</tr>
<?php endforeach; endif;  endforeach; endif; ?>
</table>
<div class="table_clear"></div>
<?php endif; ?>
