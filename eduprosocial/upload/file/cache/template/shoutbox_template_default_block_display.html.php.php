<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: January 28, 2013, 9:11 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: block.html.php 3952 2012-02-28 14:15:08Z Raymond_Benc $
 */
 
 

 if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
<div class="block<?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?> js_sortable<?php endif;  if (isset ( $this->_aVars['sCustomClassName'] )): ?> <?php echo $this->_aVars['sCustomClassName'];  endif; ?>"<?php if (isset ( $this->_aVars['sBlockBorderJsId'] )): ?> id="js_block_border_<?php echo $this->_aVars['sBlockBorderJsId']; ?>"<?php endif;  if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) && Phpfox ::getLib('module')->blockIsHidden('js_block_border_' . $this->_aVars['sBlockBorderJsId'] . '' )): ?> style="display:none;"<?php endif; ?>>
<?php if (! empty ( $this->_aVars['sHeader'] ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
		<div class="title <?php if (defined ( 'PHPFOX_IN_DESIGN_MODE' ) || Phpfox ::getService('theme')->isInDnDMode()): ?>js_sortable_header<?php endif; ?>">		
<?php if (isset ( $this->_aVars['sBlockTitleBar'] )): ?>
<?php echo $this->_aVars['sBlockTitleBar']; ?>
<?php endif; ?>
<?php if (( isset ( $this->_aVars['aEditBar'] ) && Phpfox ::isUser())): ?>
			<div class="js_edit_header_bar">
				<a href="#" title="<?php echo Phpfox::getPhrase('core.edit_this_block'); ?>" onclick="$.ajaxCall('<?php echo $this->_aVars['aEditBar']['ajax_call']; ?>', 'block_id=<?php echo $this->_aVars['sBlockBorderJsId'];  if (isset ( $this->_aVars['aEditBar']['params'] )):  echo $this->_aVars['aEditBar']['params'];  endif; ?>'); return false;"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_edit.png','alt' => '','class' => 'v_middle')); ?></a>				
			</div>
<?php endif; ?>
<?php if (true || isset ( $this->_aVars['sDeleteBlock'] )): ?>
			<div class="js_edit_header_bar js_edit_header_hover" style="display:none;">
<?php if (Phpfox ::getService('theme')->isInDnDMode()): ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')){
					$(this).parents('.block:first').remove(); $.ajaxCall('core.removeBlockDnD', 'sController=' + oParams['sController'] 
					+ '&amp;block_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>');} return false;"title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>
<?php else: ?>
					<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('core.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.block:first').remove();
					$.ajaxCall('core.hideBlock', '<?php if (isset ( $this->_aVars['sCustomDesignId'] )): ?>custom_item_id=<?php echo $this->_aVars['sCustomDesignId']; ?>&amp;<?php endif; ?>sController=' + oParams['sController'] + '&amp;type_id=<?php if (isset ( $this->_aVars['sDeleteBlock'] )):  echo $this->_aVars['sDeleteBlock'];  else: ?> <?php echo $this->_aVars['sBlockBorderJsId'];  endif; ?>&amp;block_id=' + $(this).parents('.block:first').attr('id')); } return false;" title="<?php echo Phpfox::getPhrase('core.remove_this_block'); ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/application_delete.png','alt' => '','class' => 'v_middle')); ?>
					</a>				
<?php endif; ?>
			</div>
			
<?php endif; ?>
<?php if (empty ( $this->_aVars['sHeader'] )): ?>
<?php echo $this->_aVars['sBlockShowName']; ?>
<?php else: ?>
<?php echo $this->_aVars['sHeader']; ?>
<?php endif; ?>
		</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aEditBar'] )): ?>
	<div id="js_edit_block_<?php echo $this->_aVars['sBlockBorderJsId']; ?>" class="edit_bar" style="display:none;"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aMenu'] ) && count ( $this->_aVars['aMenu'] )): ?>
	<div class="menu">
	<ul>
<?php if (count((array)$this->_aVars['aMenu'])):  $this->_aPhpfoxVars['iteration']['content'] = 0;  foreach ((array) $this->_aVars['aMenu'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['content']++; ?>
 
		<li class="<?php if (count ( $this->_aVars['aMenu'] ) == $this->_aPhpfoxVars['iteration']['content']): ?> last<?php endif;  if ($this->_aPhpfoxVars['iteration']['content'] == 1): ?> first active<?php endif; ?>"><a href="<?php echo $this->_aVars['sLink']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a></li>
<?php endforeach; endif; ?>
	</ul>
	<div class="clear"></div>
	</div>
<?php unset($this->_aVars['aMenu']); ?>
<?php endif; ?>
	<div class="content"<?php if (isset ( $this->_aVars['sBlockJsId'] )): ?> id="js_block_content_<?php echo $this->_aVars['sBlockJsId']; ?>"<?php endif; ?>>
<?php endif; ?>
		<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Shoutbox
 * @version 		$Id: display.html.php 2905 2011-08-26 17:52:00Z Raymond_Benc $
 */
 
 

?>
<script type="text/javascript">
<?php echo '
	function addShoutOut(oObj)
	{
		if ($(\'#js_shoutbox_input\').val() == \'\')
		{
			return false;
		}
		
		$(\'#js_shoutbox_form\').hide();
		'; ?>

		$('#js_shoutbox_message').html($.ajaxProcess('<?php echo Phpfox::getPhrase('shoutbox.adding_your_shoutout', array('phpfox_squote' => true)); ?>'));
		<?php echo '
		$(oObj).ajaxCall(\'shoutbox.add\');
		
		return false;
	}
'; ?>

</script>
<div id="js_shoutbox_messages" class="label_flow shoutbox_holder">
<?php if (count((array)$this->_aVars['aShoutouts'])):  $this->_aPhpfoxVars['iteration']['shoutout'] = 0;  foreach ((array) $this->_aVars['aShoutouts'] as $this->_aVars['iShoutCount'] => $this->_aVars['aShoutout']):  $this->_aPhpfoxVars['iteration']['shoutout']++; ?>

	<?php /* Cached: January 28, 2013, 9:11 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Shoutbox
 * @version 		$Id: entry.html.php 1298 2009-12-05 16:19:23Z Raymond_Benc $
 */
 
 

?>
	<div class="js_shoutbox_messages <?php if (isset ( $this->_aVars['bShoutboxAjax'] )): ?>row2 row_first<?php else:  if (is_int ( $this->_aVars['iShoutCount'] / 2 )): ?>row1<?php else: ?>row2<?php endif;  if (( $this->_aVars['iShoutCount'] + 1 ) == 1): ?> row_first<?php endif;  endif; ?>" style="position:relative;">
<?php if (Phpfox ::getUserParam('shoutbox.can_delete_all_shoutbox_messages')): ?>
	<div style="position:absolute; right:1px">
		<a href="#" onclick="if (confirm('<?php echo Phpfox::getPhrase('shoutbox.are_you_sure', array('phpfox_squote' => true)); ?>')) { $(this).parents('.js_shoutbox_messages:first').remove(); $.ajaxCall('shoutbox.delete', 'id=<?php echo $this->_aVars['aShoutout']['shout_id']; ?>&amp;module=<?php echo $this->_aVars['aShoutout']['module']; ?>'); } return false;" title="<?php echo Phpfox::getPhrase('shoutbox.delete_this_shoutout'); ?>"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/delete.gif')); ?></a>
	</div>
<?php endif; ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('user' => $this->_aVars['aShoutout'],'suffix' => '_20_square','max_width' => 20,'max_height' => 20,'style' => 'vertical-align:middle;')); ?> <?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aShoutout']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aShoutout']['user_name'], ((empty($this->_aVars['aShoutout']['user_name']) && isset($this->_aVars['aShoutout']['profile_page_id'])) ? $this->_aVars['aShoutout']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aShoutout']['full_name'], 30, '...') . '</a></span>'; ?>
		<div class="extra_info">
<?php echo Phpfox::getTime(Phpfox::getParam('shoutbox.shoutbox_time_stamp'), $this->_aVars['aShoutout']['time_stamp']); ?>
		</div>
		<div class="p_4">
<?php echo $this->_aVars['aShoutout']['text']; ?>
		</div>
	</div>
<?php endforeach; endif; ?>
</div>
<div id="js_shoutbox_form">
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" onsubmit="return addShoutOut(this);">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if (isset ( $this->_aVars['aCallbackShoutbox']['module'] )): ?>
		<div><input type="hidden" name="module" value="<?php echo $this->_aVars['aCallbackShoutbox']['module']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['aCallbackShoutbox']['item'] )): ?>
		<div><input type="hidden" name="item" value="<?php echo $this->_aVars['aCallbackShoutbox']['item']; ?>" /></div>
<?php endif; ?>
		<div><input id="js_shoutbox_input" type="text" name="shoutout" size="20" maxlength="255" value="" class="shoutbox_input" /></div>
	
</form>

</div>
<div id="js_shoutbox_message"></div>
<?php if (Phpfox ::getParam('shoutbox.shoutbox_is_live')): ?>
<script type="text/javascript">setTimeout("$.ajaxCall('shoutbox.getMessages', <?php if (isset ( $this->_aVars['aCallbackShoutbox']['module'] )): ?>'module=<?php echo $this->_aVars['aCallbackShoutbox']['module']; ?>&item=<?php echo $this->_aVars['aCallbackShoutbox']['item']; ?>'<?php else: ?>''<?php endif; ?>, 'GET')", <?php echo $this->_aVars['iShoutboxRefresh']; ?>);</script>
<?php endif; ?>

		
		
<?php if (( isset ( $this->_aVars['sHeader'] ) && ( ! PHPFOX_IS_AJAX || isset ( $this->_aVars['bPassOverAjaxCall'] ) || isset ( $this->_aVars['bIsAjaxLoader'] ) ) ) || ( defined ( "PHPFOX_IN_DESIGN_MODE" ) && PHPFOX_IN_DESIGN_MODE ) || ( Phpfox ::getService('theme')->isInDnDMode())): ?>
	</div>
<?php if (isset ( $this->_aVars['aFooter'] ) && count ( $this->_aVars['aFooter'] )): ?>
	<div class="bottom">
		<ul>
<?php if (count((array)$this->_aVars['aFooter'])):  $this->_aPhpfoxVars['iteration']['block'] = 0;  foreach ((array) $this->_aVars['aFooter'] as $this->_aVars['sPhrase'] => $this->_aVars['sLink']):  $this->_aPhpfoxVars['iteration']['block']++; ?>

				<li id="js_block_bottom_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"<?php if ($this->_aPhpfoxVars['iteration']['block'] == 1): ?> class="first"<?php endif; ?>>
<?php if ($this->_aVars['sLink'] == '#'): ?>
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif','class' => 'ajax_image')); ?>
<?php endif; ?>
					<a href="<?php echo $this->_aVars['sLink']; ?>" id="js_block_bottom_link_<?php echo $this->_aPhpfoxVars['iteration']['block']; ?>"><?php echo $this->_aVars['sPhrase']; ?></a>
				</li>
<?php endforeach; endif; ?>
		</ul>
	</div>
<?php endif; ?>
</div>
<?php unset($this->_aVars['sHeader'], $this->_aVars['sModule'], $this->_aVars['sComponent'], $this->_aVars['aFooter'], $this->_aVars['sBlockBorderJsId'], $this->_aVars['bBlockDisableSort'], $this->_aVars['bBlockCanMove'], $this->_aVars['aEditBar'], $this->_aVars['sDeleteBlock'], $this->_aVars['sBlockTitleBar'], $this->_aVars['sBlockJsId'], $this->_aVars['sCustomClassName']);  endif; ?>

<?php Phpfox::getBlock('ad.inner', array('sClass' => $this->_aVars['sClass'])); ?>
