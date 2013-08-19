<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 11:45 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: upload.html.php 3346 2011-10-24 15:20:05Z Raymond_Benc $
 */
 
 

 if ($this->_aVars['bIsEdit']): ?>
<div class="view_item_link">
	<a href="<?php echo Phpfox::permalink('music', $this->_aVars['aForms']['song_id'], $this->_aVars['aForms']['title'], false, null, (array) array (
)); ?>"><?php echo Phpfox::getPhrase('music.view_song'); ?></a>
</div>
<?php endif; ?>

<?php echo $this->_aVars['sCreateJs']; ?>
<div id="js_actual_upload_form">
<?php if ($this->_aVars['bIsEdit']): ?>
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.upload'); ?>">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
	<div><input type="hidden" name="id" value="<?php echo $this->_aVars['aForms']['song_id']; ?>" /></div>
	<div><input type="hidden" name="upload_via_song" value="1" /></div>
<?php else: ?>
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.upload'); ?>" id="js_music_form" enctype="multipart/form-data" onsubmit="return $Core.music.upload(<?php echo $this->_aVars['sGetJsForm']; ?>);" target="js_upload_frame">
<?php endif; ?>
<?php if (isset ( $this->_aVars['sModule'] ) && $this->_aVars['sModule']): ?>
		<div><input type="hidden" name="val[callback_module]" value="<?php echo $this->_aVars['sModule']; ?>" /></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['iItem'] ) && $this->_aVars['iItem']): ?>
		<div><input type="hidden" name="val[callback_item_id]" value="<?php echo $this->_aVars['iItem']; ?>" /></div>
<?php endif; ?>
		<div id="js_music_upload_song">
			<div><input type="hidden" name="val[method]" value="<?php echo $this->_aVars['sMethod']; ?>"></div>
			<?php /* Cached: May 28, 2013, 11:45 am */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: upload.html.php 4328 2012-06-25 13:49:41Z Miguel_Espinoza $
 */
 
 

?>
<div id="js_music_form_holder">
<?php if (! $this->_aVars['bIsEdit']): ?>
	<div class="message" style="font-weight:normal;">
		<p>
<?php echo Phpfox::getPhrase('music.you_retain_all_rights_in_your_music_that_you_upload_you_must_only_upload_music_in_which_you_own_all'); ?>
		</p>
		<p>
<?php echo Phpfox::getPhrase('music.uploading_copyrighted_music_without_the_explicit_consent_of_the_copyright_owner_will_result_in_your'); ?>
		</p>
	</div>		
	
	<div class="valid_message" id="js_music_upload_valid_message" style="display:none;">
<?php echo Phpfox::getPhrase('music.successfully_uploaded_the_mp3'); ?>
	</div>	
			
	<div class="main_break"></div>
<?php endif; ?>
<?php if (isset ( $this->_aVars['sModule'] ) && $this->_aVars['sModule']): ?>
	
<?php else: ?>
	<div id="js_custom_privacy_input_holder">
<?php if ($this->_aVars['bIsEdit'] && Phpfox ::isModule('privacy')): ?>
<?php if (isset ( $this->_aVars['bIsEditAlbum'] )): ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['album_id'],'privacy_module_id' => 'music_album')); ?>
<?php else: ?>
<?php Phpfox::getBlock('privacy.build', array('privacy_item_id' => $this->_aVars['aForms']['song_id'],'privacy_module_id' => 'music_song')); ?>
<?php endif; ?>
<?php endif; ?>
	</div>	
<?php endif; ?>
<?php if (isset ( $this->_aVars['bIsEditAlbum'] ) && $this->_aVars['bIsEdit']): ?>
	<div><input type="hidden" name="val[inline]" value="1" /></div>
	<div><input type="hidden" name="val[album_id]" value="<?php echo $this->_aVars['aForms']['album_id']; ?>" /></div>
<?php endif; ?>
	
<?php if (! isset ( $this->_aVars['bIsEditAlbum'] )): ?>
	<div class="table">
		<div class="table_left">
<?php if (isset ( $this->_aVars['aUploadAlbums'] ) && count ( $this->_aVars['aUploadAlbums'] )): ?>
<?php echo Phpfox::getPhrase('music.album'); ?>:
<?php else: ?>
<?php echo Phpfox::getPhrase('music.album_name'); ?>:
<?php endif; ?>
		</div>
		<div class="table_right">
<?php if (isset ( $this->_aVars['aUploadAlbums'] ) && count ( $this->_aVars['aUploadAlbums'] )): ?>
			<select name="val[album_id]" id="music_album_id_select" onchange="if (empty(this.value)) { $('#js_song_privacy_holder').slideDown(); } else { $('#js_song_privacy_holder').slideUp(); }">
				<option value=""><?php echo Phpfox::getPhrase('music.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aUploadAlbums'])):  foreach ((array) $this->_aVars['aUploadAlbums'] as $this->_aVars['aAlbum']): ?>
				<option value="<?php echo $this->_aVars['aAlbum']['album_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('album_id') && in_array('album_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['album_id'])
								&& $aParams['album_id'] == $this->_aVars['aAlbum']['album_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['album_id'])
									&& !isset($aParams['album_id'])
									&& $this->_aVars['aForms']['album_id'] == $this->_aVars['aAlbum']['album_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']); ?></option>
<?php endforeach; endif; ?>
			</select>
			<div class="extra_info_link"><a href="#" onclick="$('#js_create_new_music_album').show(); $('#js_create_new_music_album input').focus(); return false;"><?php echo Phpfox::getPhrase('music.or_create_a_new_album'); ?></a></div>
			<div id="js_create_new_music_album" class="p_top_8" style="display:none;">
				<input type="text" name="val[new_album_title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['new_album_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['new_album_title']) : (isset($this->_aVars['aForms']['new_album_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['new_album_title']) : '')); ?>
" size="30" />
			</div>
<?php else: ?>
			<input type="text" name="val[new_album_title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['new_album_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['new_album_title']) : (isset($this->_aVars['aForms']['new_album_title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['new_album_title']) : '')); ?>
" size="30" /> <span class="extra_info"><?php echo Phpfox::getPhrase('music.optional'); ?></span>
<?php endif; ?>
		</div>
	</div>	
<?php endif; ?>
	
	<div class="table song_name">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('music.song_name'); ?>:
		</div>
		<div class="table_right">
			<input type="text" name="val[title]" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['title']) : (isset($this->_aVars['aForms']['title']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['title']) : '')); ?>
" size="30" id="title" />
		</div>
	</div>
	
	<div class="table song_name">
		<div class="table_left">
<?php echo Phpfox::getPhrase('music.genre'); ?>:
		</div>
		<div class="table_right">
			<select name="val[genre_id]">
				<option value=""><?php echo Phpfox::getPhrase('music.select'); ?>:</option>
<?php if (count((array)$this->_aVars['aGenres'])):  foreach ((array) $this->_aVars['aGenres'] as $this->_aVars['aGenre']): ?>
				<option value="<?php echo $this->_aVars['aGenre']['genre_id']; ?>"<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val'));


if (isset($this->_aVars['aField']) && isset($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]) && !is_array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]))
							{
								$this->_aVars['aForms'][$this->_aVars['aField']['field_id']] = array($this->_aVars['aForms'][$this->_aVars['aField']['field_id']]);
							}

if (isset($this->_aVars['aForms'])
 && is_numeric('genre_id') && in_array('genre_id', $this->_aVars['aForms']))
							
{
								echo ' selected="selected" ';
							}

							if (isset($aParams['genre_id'])
								&& $aParams['genre_id'] == $this->_aVars['aGenre']['genre_id'])

							{

								echo ' selected="selected" ';

							}

							else

							{

								if (isset($this->_aVars['aForms']['genre_id'])
									&& !isset($aParams['genre_id'])
									&& $this->_aVars['aForms']['genre_id'] == $this->_aVars['aGenre']['genre_id'])
								{
								 echo ' selected="selected" ';
								}
								else
								{
									echo "";
								}
							}
							?>
><?php echo Phpfox::getLib('locale')->convert($this->_aVars['aGenre']['name']); ?></option>
<?php endforeach; endif; ?>
			</select>
		</div>
	</div>	
	
<?php if (isset ( $this->_aVars['sModule'] ) && $this->_aVars['sModule']): ?>
	
<?php else: ?>
<?php if ($this->_aVars['bIsEdit'] && $this->_aVars['aForms']['album_id'] > 0): ?>
	
<?php else: ?>
<?php if (! isset ( $this->_aVars['bIsEditAlbum'] ) && Phpfox ::isModule('privacy')): ?>
	<div id="js_song_privacy_holder">
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('music.privacy'); ?>:
			</div>
			<div class="table_right">	
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_info' => 'music.control_who_can_see_this_song','default_privacy' => 'music.default_privacy_setting')); ?>
			</div>			
		</div>
		
		<div class="table">
			<div class="table_left">
<?php echo Phpfox::getPhrase('music.comment_privacy'); ?>:
			</div>
			<div class="table_right">	
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy_comment','privacy_info' => 'music.control_who_can_comment_on_this_song','privacy_no_custom' => true)); ?>
			</div>			
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
	
<?php if (! isset ( $this->_aVars['bIsEditAlbum'] ) && $this->_aVars['bIsEdit']): ?>
	
<?php else: ?>
<?php if (isset ( $this->_aVars['sMethod'] ) && $this->_aVars['sMethod'] == 'massuploader'): ?>
	<div class="table mass_uploader_table">
		<div id="swf_music_upload_button_holder">
			<div class="swf_upload_holder">
				<div id="swf_music_upload_button"></div>
			</div>
			
			<div class="swf_upload_text_holder">
				<div class="swf_upload_progress"></div>
				<div class="swf_upload_text">
<?php echo Phpfox::getPhrase('music.select_mp3'); ?>
				</div>
			</div>				
		</div>
		<div class="extra_info">
<?php echo Phpfox::getPhrase('music.max_file_size'); ?>: <?php echo $this->_aVars['iUploadLimit']; ?>
		</div>			
	</div>
	<div class="mass_uploader_link"><?php echo Phpfox::getPhrase('music.upload_problems_try_the_basic_uploader', array('url' => $this->_aVars['sMethodUrl'])); ?></div>	
<?php else: ?>
	<div><input type="hidden" name="val[method]" value="simple" /></div>
	<div class="table">
		<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('music.select_mp3'); ?>:
		</div>
		<div class="table_right">		
			<div id="js_progress_uploader"></div>
			<div class="extra_info">
<?php echo Phpfox::getPhrase('music.max_file_size'); ?>: <?php echo $this->_aVars['iUploadLimit']; ?>
			</div>		
		</div>
	</div>	
	<div class="table_clear">
		<input type="submit" value="<?php echo Phpfox::getPhrase('music.upload'); ?>" class="button" />
	</div>
<?php endif; ?>
<?php endif; ?>
</div>
<?php if ($this->_aVars['bIsEdit']): ?>
			<div class="table_clear">
				<input type="submit" value="<?php echo Phpfox::getPhrase('music.update'); ?>" class="button" />
			</div>			
<?php endif; ?>
		</div>
	
</form>

</div>
