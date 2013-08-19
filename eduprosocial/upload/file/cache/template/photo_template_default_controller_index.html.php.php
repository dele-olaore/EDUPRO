<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 3:01 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: index.html.php 4166 2012-05-15 06:44:59Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['sView'] == 'my' && count ( $this->_aVars['aPhotos'] )): ?>
		<div class="item_bar">
			<div class="item_bar_action_holder">				
				<a href="#" class="item_bar_action"><span><?php echo Phpfox::getPhrase('photo.actions'); ?></span></a>		
				<ul>
					<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo', array('view' => 'my','mode' => 'edit')); ?>"><?php echo Phpfox::getPhrase('photo.mass_edit_photos'); ?></a></li>
				</ul>			
			</div>		
		</div>	    
<?php endif; ?>
<div id="js_actual_photo_content">
	<div id="js_album_outer_content">
<?php if (count ( $this->_aVars['aPhotos'] )): ?>
<?php if (isset ( $this->_aVars['bIsEditMode'] )): ?>
		<form method="post" action="#" onsubmit="$('#js_photo_multi_edit_image').show(); $('#js_photo_multi_edit_submit').hide(); $(this).ajaxCall('photo.massUpdate'<?php if ($this->_aVars['bIsMassEditUpload']): ?>, 'is_photo_upload=1'<?php endif; ?>); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if (count((array)$this->_aVars['aPhotos'])):  foreach ((array) $this->_aVars['aPhotos'] as $this->_aVars['aForms']): ?>
				<?php /* Cached: May 28, 2013, 3:01 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: edit-photo.html.php 4749 2012-09-25 06:41:43Z Raymond_Benc $
 */
 
 

 if (isset ( $this->_aVars['bSingleMode'] )): ?>
<form method="post" action="#" onsubmit="$(this).ajaxCall('photo.updatePhoto'); return false;">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="photo_id" value="<?php echo $this->_aVars['aForms']['photo_id']; ?>" /></div>
	<div><input type="hidden" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[photo_id]" value="<?php echo $this->_aVars['aForms']['photo_id']; ?>" /></div>
	<div><input type="hidden" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[album_id]" value="<?php echo $this->_aVars['aForms']['album_id']; ?>" /></div>
	<div id="js_custom_privacy_input_holder">
<?php if ($this->_aVars['aForms']['album_id'] == '0' && $this->_aVars['aForms']['group_id'] == '0'): ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['photo_id'],'privacy_module_id' => 'photo')); ?>
<?php else: ?>
		<div><input type="hidden" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[privacy]" value="<?php echo $this->_aVars['aForms']['privacy']; ?>" /></div>
		<div><input type="hidden" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[privacy_comment]" value="<?php echo $this->_aVars['aForms']['privacy_comment']; ?>" /></div>
<?php endif; ?>
	</div>	
<?php if ($this->_aVars['bIsInline']): ?>
	<div><input type="hidden" name="inline" value="1" /></div>
<?php endif;  endif; ?>
<div id="photo_edit_item_id_<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="<?php if (! isset ( $this->_aVars['bSingleMode'] )): ?>row1 <?php endif; ?>photo_edit_row">
	<div class="photo_edit_holder">
		<div class="t_center">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aForms']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aForms']['destination'],'suffix' => '_150','max_width' => 150,'max_height' => 150,'title' => $this->_aVars['aForms']['title'],'class' => 'js_mp_fix_width photo_holder','thickbox' => true)); ?>
		</div>
		<div class="p_4">
<?php if (! isset ( $this->_aVars['bIsEditMode'] ) && $this->_aVars['aForms']['album_id'] > 0): ?>
			<div class="photo_edit_input"><label><input type="radio" name="val[set_album_cover]" value="<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="v_middle"<?php if ($this->_aVars['aForms']['is_cover']): ?> checked="checked"<?php endif; ?> /> <?php echo Phpfox::getPhrase('photo.set_as_the_album_cover'); ?></label></div>
<?php endif; ?>
<?php if (! isset ( $this->_aVars['bSingleMode'] )): ?>
			<div class="photo_edit_input"><label><input type="checkbox" name="val[<?php echo $this->_aVars['aForms']['photo_id']; ?>][delete_photo]" value="<?php echo $this->_aVars['aForms']['photo_id']; ?>" class="v_middle" /> <?php echo Phpfox::getPhrase('photo.delete_this_photo_lowercase'); ?></label></div>
<?php endif; ?>
			
<?php if ($this->_aVars['aForms']['album_id'] == '0' && $this->_aVars['aForms']['group_id'] == '0'): ?>
			<div class="photo_edit_input">				
				<div class="table">
					<div class="table_left">
<?php echo Phpfox::getPhrase('photo.privacy'); ?>:
					</div>
					<div class="table_right">
					<div id="js_custom_privacy_input_holder_<?php echo $this->_aVars['aForms']['photo_id']; ?>">
<?php if (isset ( $this->_aVars['bIsEditMode'] )): ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['photo_id'],'privacy_module_id' => 'photo','privacy_array' => $this->_aVars['aForms']['photo_id'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['photo_id'],'privacy_module_id' => 'photo')); ?>
<?php endif; ?>
					</div>						
<?php if (isset ( $this->_aVars['bIsEditMode'] )): ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_info' => 'photo.control_who_can_see_this_photo','privacy_array' => $this->_aVars['aForms']['photo_id'],'privacy_custom_id' => 'js_custom_privacy_input_holder_'.$this->_aVars['aForms']['photo_id'].'')); ?>
<?php else: ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_info' => 'photo.control_who_can_see_this_photo')); ?>
<?php endif; ?>
					</div>			
				</div>
				<div class="table">
					<div class="table_left">
<?php echo Phpfox::getPhrase('photo.comment_privacy'); ?>:
					</div>
					<div class="table_right">
<?php if (isset ( $this->_aVars['bIsEditMode'] )): ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy_comment','privacy_info' => 'photo.control_who_can_comment_on_this_photo','privacy_no_custom' => true,'privacy_array' => $this->_aVars['aForms']['photo_id'])); ?>
<?php else: ?>
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy_comment','privacy_info' => 'photo.control_who_can_comment_on_this_photo','privacy_no_custom' => true)); ?>
<?php endif; ?>
					</div>			
				</div>						
			</div>
<?php endif; ?>
			
<?php if (count ( $this->_aVars['aAlbums'] )): ?>
			<div class="photo_edit_input">
<?php echo Phpfox::getPhrase('photo.move_to'); ?>:
				<div class="p_top_4">
					<select name="val[<?php echo $this->_aVars['aForms']['photo_id']; ?>][move_to]" style="width:180px;">	
						<option value=""><?php echo Phpfox::getPhrase('photo.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aAlbums'])):  foreach ((array) $this->_aVars['aAlbums'] as $this->_aVars['aAlbum']): ?>
						<option value="<?php echo $this->_aVars['aAlbum']['album_id']; ?>"><?php if ($this->_aVars['aAlbum']['profile_id'] > 0):  echo Phpfox::getPhrase('photo.profile_pictures');  else:  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']);  endif; ?></option>
<?php endforeach; endif; ?>
					</select>
				</div>
			</div>			
<?php endif; ?>
			
		</div>
	</div>
	<?php /* Cached: May 28, 2013, 3:01 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: form.html.php 4418 2012-06-29 07:32:51Z Raymond_Benc $
 */
 
 

?>
<?php if (isset ( $this->_aVars['aForms']['view_id'] ) && $this->_aVars['aForms']['view_id'] == 1): ?>
		<div class="message" style="width:85%;">
<?php echo Phpfox::getPhrase('photo.image_is_pending_approval'); ?>
		</div>
<?php endif; ?>
		<div class="table">
			<div class="table_left">
				<label for="title"><?php echo Phpfox::getPhrase('photo.title'); ?></label>:
			</div>
			<div class="table_right">
				<input type="text" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[title]" value="<?php if (isset ( $this->_aVars['aForms']['title'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']);  else:  $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : ''));  endif; ?>" size="30" maxlength="150" onfocus="this.select();" />
			</div>			
		</div>
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('photo.description'); ?>:
			</div>
			<div class="table_right">
				<textarea cols="30" rows="4" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[description]"><?php if (isset ( $this->_aVars['aForms']['description'] )):  echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']);  else:  $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['description']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['description']) : (isset($this->_aVars['aForms']['description']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['description']) : ''));  endif; ?></textarea>
			</div>			
		</div>		
		
<?php if (isset ( $this->_aVars['aForms']['group_id'] ) && $this->_aVars['aForms']['group_id'] != '0'): ?>
		
<?php else: ?>
<?php if (Phpfox ::getService('photo.category')->hasCategories()): ?>
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('photo.category'); ?>:
			</div>
			<div class="table_right js_category_list_holder">
<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?><div class="js_photo_item_id" style="display:none;"><?php echo $this->_aVars['aForms']['photo_id']; ?></div><?php endif; ?>
<?php if (isset ( $this->_aVars['aForms']['category_list'] )): ?><div class="js_photo_active_items" style="display:none;"><?php echo $this->_aVars['aForms']['category_list']; ?></div><?php endif; ?>
<?php Phpfox::getBlock('photo.drop-down', array()); ?>
			</div>			
		</div>	
<?php endif; ?>
<?php endif; ?>
	
<?php if (isset ( $this->_aVars['aForms']['group_id'] ) && $this->_aVars['aForms']['group_id'] != '0'): ?>
		
<?php else: ?>
<?php if (Phpfox ::isModule('tag') && Phpfox ::getUserParam('photo.can_add_tags_on_photos')):  if (isset ( $this->_aVars['aForms']['photo_id'] )):  Phpfox::getBlock('tag.add', array('sType' => 'photo','separate' => false,'id' => $this->_aVars['aForms']['photo_id']));  else:  Phpfox::getBlock('tag.add', array('sType' => 'photo','separate' => false));  endif;  endif; ?>
<?php endif; ?>
<?php if (Phpfox ::getUserParam('photo.can_add_mature_images')): ?>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('photo.mature_content'); ?>:
				</div>
				<div class="table_right">
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[mature]" value="2" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('mature') && in_array('mature', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['mature']) && $aParams['mature'] == '2'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['mature']) && !isset($aParams['mature']) && $this->_aVars['aForms']['mature'] == '2')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.yes_strict'); ?></label>
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[mature]" value="1" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('mature') && in_array('mature', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['mature']) && $aParams['mature'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['mature']) && !isset($aParams['mature']) && $this->_aVars['aForms']['mature'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.yes_warning'); ?></label>
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[mature]" value="0" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('mature') && in_array('mature', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['mature']) && $aParams['mature'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['mature']) && !isset($aParams['mature']) && $this->_aVars['aForms']['mature'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['mature']) && !isset($aParams['mature']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.no'); ?></label>
				</div>			
			</div>
<?php endif; ?>
			
<?php if (Phpfox ::getParam('photo.can_rate_on_photos') && Phpfox ::getUserParam('photo.can_add_to_rating_module')): ?>
			<div class="table js_public_rating">
				<div class="table_left">
<?php echo Phpfox::getPhrase('photo.public_rating'); ?>:
				</div>
				<div class="table_right">
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[allow_rate]" value="1" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('allow_rate') && in_array('allow_rate', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['allow_rate']) && $aParams['allow_rate'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['allow_rate']) && !isset($aParams['allow_rate']) && $this->_aVars['aForms']['allow_rate'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['allow_rate']) && !isset($aParams['allow_rate']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.yes'); ?></label>
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[allow_rate]" value="0" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('allow_rate') && in_array('allow_rate', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['allow_rate']) && $aParams['allow_rate'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['allow_rate']) && !isset($aParams['allow_rate']) && $this->_aVars['aForms']['allow_rate'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.no'); ?></label>				
				</div>
			</div>
<?php endif; ?>
			
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('photo.download_enabled'); ?>:
				</div>
				<div class="table_right">
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[allow_download]" value="1" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('allow_download') && in_array('allow_download', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['allow_download']) && $aParams['allow_download'] == '1'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['allow_download']) && !isset($aParams['allow_download']) && $this->_aVars['aForms']['allow_download'] == '1')
 {
    echo ' checked="checked" ';}
 else
 {
 if (!isset($this->_aVars['aForms']) || ((isset($this->_aVars['aForms']) && !isset($this->_aVars['aForms']['allow_download']) && !isset($aParams['allow_download']))))
{
 echo ' checked="checked"';
}
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.yes'); ?></label>
					<label><input type="radio" name="val<?php if (isset ( $this->_aVars['aForms']['photo_id'] )): ?>[<?php echo $this->_aVars['aForms']['photo_id']; ?>]<?php endif; ?>[allow_download]" value="0" style="vertical-align:middle;" class="checkbox"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));
if (isset($this->_aVars['aForms']) && is_numeric('allow_download') && in_array('allow_download', $this->_aVars['aForms']) ){echo ' checked="checked"';}
if ((isset($aParams['allow_download']) && $aParams['allow_download'] == '0'))
{echo ' checked="checked" ';}
else
{
 if (isset($this->_aVars['aForms']) && isset($this->_aVars['aForms']['allow_download']) && !isset($aParams['allow_download']) && $this->_aVars['aForms']['allow_download'] == '0')
 {
    echo ' checked="checked" ';}
 else
 {
 }
}
?> 
/> <?php echo Phpfox::getPhrase('photo.no'); ?></label>
					<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.enabling_this_option_will_allow_others_the_rights_to_download_this_photo'); ?>
					</div>				
				</div>
			</div>
<?php if (isset ( $this->_aVars['bSingleMode'] )): ?>
		<div class="table_clear">
			<input type="submit" value="<?php echo Phpfox::getPhrase('photo.update'); ?>" class="button" />
		</div>
<?php endif; ?>
</div>
<?php if (isset ( $this->_aVars['bSingleMode'] )): ?>

</form>

<?php endif; ?>
<?php endforeach; endif; ?>
			<div class="photo_table_clear">
				<div id="js_photo_multi_edit_image" style="display:none;">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'ajax/add.gif')); ?>
				</div>		
				<div id="js_photo_multi_edit_submit">
					<input type="submit" value="<?php echo Phpfox::getPhrase('photo.update_photo_s'); ?>" class="button" />
				</div>
			</div>
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
		
</form>

<?php else: ?>
		<?php /* Cached: May 28, 2013, 3:01 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: photo-entry.html.php 4968 2012-10-30 11:55:11Z Miguel_Espinoza $
 */
 
 

 if (count((array)$this->_aVars['aPhotos'])):  $this->_aPhpfoxVars['iteration']['photos'] = 0;  foreach ((array) $this->_aVars['aPhotos'] as $this->_aVars['aPhoto']):  $this->_aPhpfoxVars['iteration']['photos']++; ?>

<div class="<?php if ($this->_aVars['aPhoto']['view_id'] == 1 && ! isset ( $this->_aVars['bIsInApproveMode'] )): ?> row_moderate_image<?php endif; ?> <?php if ($this->_aVars['aPhoto']['is_sponsor']): ?> row_sponsored_image<?php endif;  if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'):  else:  if ($this->_aVars['aPhoto']['is_featured']): ?> row_featured_image<?php endif;  endif; ?> photo_row" id="js_photo_id_<?php echo $this->_aVars['aPhoto']['photo_id']; ?>">
	<div class="js_outer_photo_div js_mp_fix_holder photo_row_holder">
	
		<div class="photo_row_height image_hover_holder">
<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
			<div class="photo_clip_holder_main">
<?php endif; ?>
<?php if (( $this->_aVars['aPhoto']['view_id'] == 1 && Phpfox ::getUserParam('photo.can_approve_photos')) || ( $this->_aVars['aPhoto']['user_id'] == Phpfox ::getUserId() && ( Phpfox ::getUserParam('photo.can_edit_own_photo_album') || Phpfox ::getUserParam('photo.can_edit_own_photo') || Phpfox ::getUserParam('photo.can_delete_own_photo'))) || ( Phpfox ::getUserParam('photo.can_edit_other_photo_albums') || Phpfox ::getUserParam('photo.can_edit_other_photo') || Phpfox ::getUserParam('photo.can_delete_other_photos')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
				
				<a href="#" class="image_hover_menu_link"><?php echo Phpfox::getPhrase('photo.link'); ?></a>
				
				<div class="image_hover_menu">
					<ul>
<?php if (( ( Phpfox ::getUserParam('photo.can_delete_own_photo') && $this->_aVars['aPhoto']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_delete_other_photos')) || ( defined ( 'PHPFOX_IS_PAGES_VIEW' ) && Phpfox ::getService('pages')->isAdmin('' . $this->_aVars['aPage']['page_id'] . '' ) )): ?>
					   <li class="item_delete"><a href="#" title="<?php echo Phpfox::getPhrase('photo.delete_this_photo'); ?>" onclick="if (confirm('<?php echo Phpfox::getPhrase('photo.are_you_sure', array('phpfox_squote' => true)); ?>')) $.ajaxCall('photo.deletePhoto', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>'); return false;"><?php echo Phpfox::getPhrase('photo.delete_photo'); ?></a></li>
<?php endif; ?>
					
<?php if (Phpfox ::getUserParam('photo.can_sponsor_photo')): ?>
						<li id="js_photo_sponsor_<?php echo $this->_aVars['aPhoto']['photo_id']; ?>">
							<a href="#" onclick="$.ajaxCall('photo.sponsor', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>&type=<?php if ($this->_aVars['aPhoto']['is_sponsor'] == 1): ?>0<?php else: ?>1<?php endif; ?>');return false;"> <?php if ($this->_aVars['aPhoto']['is_sponsor'] == 1):  echo Phpfox::getPhrase('photo.unsponsor_this_photo');  else:  echo Phpfox::getPhrase('photo.sponsor_this_photo');  endif; ?></a>
						</li>
<?php endif; ?>
					
<?php if (isset ( $this->_aVars['aPage'] ) && isset ( $this->_aVars['aPage']['page_id'] )): ?>
						<li>
							<a href="#" title="Set this as your Page's cover photo" onclick="$Core.Pages.setAsCover(<?php echo $this->_aVars['aPage']['page_id']; ?>,<?php echo $this->_aVars['aPhoto']['photo_id']; ?>); return false;">
								Set as your page's cover photo
							</a>
						</li>
<?php endif; ?>

<?php if (Phpfox ::getParam('photo.display_profile_photo_within_gallery') == false && ( ( isset ( $this->_aVars['aPhoto']['is_profile_photo'] ) && ! $this->_aVars['aPhoto']['is_profile_photo'] ) || ! isset ( $this->_aVars['aPhoto']['is_profile_photo'] ) )): ?>
<?php if (Phpfox ::getUserParam('photo.can_feature_photo') && ! $this->_aVars['aPhoto']['is_sponsor']): ?>
							<li id="js_photo_feature_<?php echo $this->_aVars['aPhoto']['photo_id']; ?>">
<?php if ($this->_aVars['aPhoto']['is_featured']): ?>
								<a href="#" title="<?php echo Phpfox::getPhrase('photo.un_feature_this_photo'); ?>" onclick="$.ajaxCall('photo.feature', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>&amp;type=0', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.un_feature'); ?></a>
<?php else: ?>
							<a href="#" title="<?php echo Phpfox::getPhrase('photo.feature_this_photo'); ?>" onclick="$.ajaxCall('photo.feature', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>&amp;type=1', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.feature'); ?></a>
<?php endif; ?>
							</li>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_aVars['aPhoto']['user_id'] == Phpfox ::getUserId()): ?>
					<li>
						<a href="#" title="Set this photo as your profile image." onclick="tb_show('', '', null, '<?php echo Phpfox::getPhrase('photo.setting_this_photo_as_your_profile_picture_please_hold'); ?>', true); $.ajaxCall('photo.makeProfilePicture', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('photo.make_profile_picture'); ?></a>
					</li>
<?php if (Phpfox ::getUserParam('profile.can_change_cover_photo')): ?>
					<li>
						<a href="#" title="<?php echo Phpfox::getPhrase('user.set_this_photo_as_your_profile_cover_photo'); ?>" onclick="$.ajaxCall('user.setCoverPhoto', 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>', 'GET'); return false;"><?php echo Phpfox::getPhrase('user.set_as_cover_photo'); ?></a>
					</li>			
<?php endif; ?>
<?php endif; ?>
					
<?php if (( Phpfox ::getUserParam('photo.can_edit_own_photo') && $this->_aVars['aPhoto']['user_id'] == Phpfox ::getUserId()) || Phpfox ::getUserParam('photo.can_edit_other_photo')): ?>
					    <li><a href="#" title="<?php echo Phpfox::getPhrase('photo.edit_this_photo'); ?>"onclick="$Core.box('photo.editPhoto', 700, 'photo_id=<?php echo $this->_aVars['aPhoto']['photo_id']; ?>&amp;inline=true'); $('#js_tag_photo').hide();return false;"><?php echo Phpfox::getPhrase('photo.edit_photo'); ?></a></li>
<?php endif; ?>

<?php (($sPlugin = Phpfox_Plugin::get('photo.template_default_block_photo_entry_hover_end')) ? eval($sPlugin) : false); ?>
					</ul>
				</div>
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_default_block_photo_entry_tool')) ? eval($sPlugin) : false); ?>
				
				
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'featured'): ?>
<?php else: ?>
			<div class="js_featured_photo row_featured_link"<?php if (! $this->_aVars['aPhoto']['is_featured']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('photo.featured'); ?>
			</div>					
<?php endif; ?>
			<div class="js_sponsor_photo row_sponsored_link"<?php if (! $this->_aVars['aPhoto']['is_sponsor']): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('photo.sponsored'); ?>
			</div>
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'pending'): ?>
<?php else: ?>
			<div class="js_pending_photo row_pending_link"<?php if ($this->_aVars['aPhoto']['view_id'] != '1'): ?> style="display:none;"<?php endif; ?>>
<?php echo Phpfox::getPhrase('photo.pending'); ?>
			</div>
<?php endif; ?>
			
<?php if (Phpfox ::getUserParam('photo.can_approve_photos') || Phpfox ::getUserParam('photo.can_delete_other_photos')): ?>
			<div class="video_moderate_link"><a href="#<?php echo $this->_aVars['aPhoto']['photo_id']; ?>" class="moderate_link" rel="photo"><?php echo Phpfox::getPhrase('photo.moderate'); ?></a></div>				
<?php endif; ?>
			
<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
				<div class="photo_clip_holder_border">
					<a href="<?php echo $this->_aVars['aPhoto']['link'];  if (isset ( $this->_aVars['iForceAlbumId'] )): ?>albumid_<?php echo $this->_aVars['iForceAlbumId']; ?>/<?php endif; ?>" style="background:url('<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aPhoto']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aPhoto']['destination'],'suffix' => '_240','max_width' => 240,'max_height' => 240,'return_url' => true)); ?>') no-repeat;" class="thickbox photo_holder_image photo_clip_holder" rel="<?php echo $this->_aVars['aPhoto']['photo_id']; ?>" title="<?php echo Phpfox::getPhrase('photo.title_by_full_name', array('title' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['title']),'full_name' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['full_name']))); ?>"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['title']), 45, '...'), 20); ?></a>
				</div>			
<?php else: ?>
<?php if (( $this->_aVars['aPhoto']['mature'] == 0 || ( ( $this->_aVars['aPhoto']['mature'] == 1 || $this->_aVars['aPhoto']['mature'] == 2 ) && Phpfox ::getUserId() && Phpfox ::getUserParam('photo.photo_mature_age_limit') <= Phpfox ::getUserBy('age'))) || $this->_aVars['aPhoto']['user_id'] == Phpfox ::getUserId()): ?>
			<a href="<?php echo $this->_aVars['aPhoto']['link'];  if (isset ( $this->_aVars['iForceAlbumId'] )): ?>albumid_<?php echo $this->_aVars['iForceAlbumId']; ?>/<?php endif;  if (isset ( $this->_aVars['sPhotoCategory'] )): ?>category_<?php echo $this->_aVars['sPhotoCategory']; ?>/<?php endif; ?>" title="<?php echo Phpfox::getPhrase('photo.title_by_full_name', array('title' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['title']),'full_name' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['full_name']))); ?>" class="thickbox photo_holder_image" rel="<?php echo $this->_aVars['aPhoto']['photo_id']; ?>">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aPhoto']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aPhoto']['destination'],'suffix' => '_150','max_width' => 120,'max_height' => 120,'title' => $this->_aVars['aPhoto']['title'],'class' => 'js_mp_fix_width photo_holder')); ?>
			</a>
<?php else: ?>
			<a href="<?php echo $this->_aVars['aPhoto']['link'];  if (isset ( $this->_aVars['iForceAlbumId'] )): ?>albumid_<?php echo $this->_aVars['iForceAlbumId']; ?>/<?php endif; ?>"<?php if ($this->_aVars['aPhoto']['mature'] == 1): ?> onclick="tb_show('<?php echo Phpfox::getPhrase('photo.warning', array('phpfox_squote' => true)); ?>', $.ajaxBox('photo.warning', 'height=300&amp;width=350&amp;link=<?php echo $this->_aVars['aPhoto']['link']; ?>')); return false;"<?php endif; ?> class="no_ajax_link"><?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'misc/no_access.png','alt' => '')); ?></a>
<?php endif; ?>
<?php endif; ?>
			
<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
			</div>
<?php endif; ?>
		</div>
		
		<div class="photo_row_info">			
<?php if (! isset ( $this->_aVars['bIsInAlbumMode'] )): ?>
			<div class="extra_info_link">
<?php echo Phpfox::getPhrase('photo.by_user_info', array('user_info' => Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten('<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aPhoto']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aPhoto']['user_name'], ((empty($this->_aVars['aPhoto']['user_name']) && isset($this->_aVars['aPhoto']['profile_page_id'])) ? $this->_aVars['aPhoto']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aPhoto']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>', 30, '...'), 20))); ?>
<?php if (! empty ( $this->_aVars['aPhoto']['album_name'] )): ?>
				<div><?php echo Phpfox::getPhrase('photo.in'); ?> <a href="<?php echo Phpfox::permalink('photo.album', $this->_aVars['aPhoto']['album_id'], $this->_aVars['aPhoto']['album_name'], false, null, (array) array (
)); ?>" title="<?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['album_name']); ?>"><?php if ($this->_aVars['aPhoto']['album_profile_id'] > 0):  echo Phpfox::getPhrase('photo.profile_pictures');  else:  echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aPhoto']['album_name']), 45, '...'), 20);  endif; ?></a></div>
<?php endif; ?>
			</div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'top-rated'): ?>
			<div class="p_2">
<?php echo Phpfox::getPhrase('photo.total_rating_out_of_5', array('total_rating' => round($this->_aVars['aPhoto']['total_rating']))); ?>
			</div>
<?php elseif (isset ( $this->_aVars['sView'] ) && $this->_aVars['sView'] == 'top-battle'): ?>
			<div class="p_2">
<?php echo Phpfox::getPhrase('photo.total_battle_win_s', array('total_battle' => $this->_aVars['aPhoto']['total_battle'])); ?>
			</div>			
<?php endif; ?>
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_default_block_photo_entry_info')) ? eval($sPlugin) : false); ?>
		</div>			
	</div>
</div>
<?php if (is_int ( $this->_aPhpfoxVars['iteration']['photos'] / 3 ) || Phpfox ::isMobile()): ?>
<div class="clear"></div>
<?php endif;  endforeach; endif; ?>
<div class="clear"></div>
<div class="t_right">
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager'); ?>
</div>
<?php if (Phpfox ::getUserParam('photo.can_approve_photos') || Phpfox ::getUserParam('photo.can_delete_other_photos')): ?>
<?php Phpfox::getBlock('core.moderation'); ?>
<?php endif; ?>
<?php endif; ?>
<?php else: ?>
		<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.no_photos_found'); ?>
		</div>
<?php endif; ?>
	</div>
</div>
