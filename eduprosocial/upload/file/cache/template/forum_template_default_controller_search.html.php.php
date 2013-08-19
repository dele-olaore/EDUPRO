<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: August 6, 2013, 7:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: $
 */
 
 

?>
<div class="main_break"></div>
<form method="post" action="<?php if ($this->_aVars['aCallback'] === false):  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search');  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('forum.search', array('module' => 'group','item' => $this->_aVars['aCallback']['group_id']));  endif; ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['aCallback'] !== false): ?>
	<div><input type="hidden" name="search[group_id]" value="<?php echo $this->_aVars['aCallback']['group_id']; ?>" /></div>
<?php endif; ?>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.search_for_keyword_s'); ?>:
		</div>
		<div class="table_right">
<?php echo $this->_aVars['aFilters']['keyword']; ?>
		</div>
	</div>	
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.search_for_author'); ?>:
		</div>
		<div class="table_right">
<?php echo $this->_aVars['aFilters']['user']; ?>
		</div>
	</div>			

	<h3><?php echo Phpfox::getPhrase('forum.search_options'); ?></h3>
<?php if ($this->_aVars['aCallback'] === false): ?>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.find_in_forum'); ?>:
		</div>
		<div class="table_right">
			<select name="search[forum][]" style="width:90%;" multiple="multiple" size="10">
<?php echo $this->_aVars['sForumList']; ?>
			</select>
		</div>
	</div>	
	
	<div class="separate"></div>
<?php endif; ?>
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.display'); ?>:
		</div>
		<div class="table_right">			
<?php echo $this->_aVars['aFilters']['display']; ?>
		</div>
	</div>
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.sort'); ?>:
		</div>
		<div class="table_right">			
<?php echo $this->_aVars['aFilters']['sort']; ?> in <?php echo $this->_aVars['aFilters']['sort_by']; ?>
		</div>
	</div>
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.from'); ?>:
		</div>
		<div class="table_right">			
<?php echo $this->_aVars['aFilters']['days_prune']; ?>
		</div>
	</div>
	
	<div class="table">
		<div class="table_left">
<?php echo Phpfox::getPhrase('forum.display_results_as'); ?>:
		</div>
		<div class="table_right">			
<?php echo $this->_aVars['aFilters']['result']; ?>
		</div>
	</div>		

	<div class="table_clear">
		<input type="submit" name="search[submit]" value="<?php echo Phpfox::getPhrase('forum.search'); ?>" class="button" />
	</div>

</form>

