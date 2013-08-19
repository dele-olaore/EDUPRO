<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 1:15 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: album.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

?>
<div id="js_actual_upload_form">
<?php echo $this->_aVars['sCreateJs']; ?>
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('current'); ?>" enctype="multipart/form-data">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
<?php if ($this->_aVars['bIsEdit']): ?>
		<div><input type="hidden" name="album_edit_id" value="<?php echo $this->_aVars['aForms']['album_id']; ?>" /></div>
<?php endif; ?>
		
		<div id="js_upload_music_detail" class="page_section_menu_holder">
			<div class="table">
				<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('music.name'); ?>:
				</div>
				<div class="table_right">
					<input type="text" name="val[name]" size="30" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['name']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['name']) : (isset($this->_aVars['aForms']['name']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['name']) : '')); ?>
" id="name" />
				</div>
			</div>
			<div class="table">
				<div class="table_left">
<?php if (Phpfox::getParam('core.display_required')): ?><span class="required"><?php echo Phpfox::getParam('core.required_symbol'); ?></span><?php endif;  echo Phpfox::getPhrase('music.year'); ?>:
				</div>
				<div class="table_right">
					<input type="text" name="val[year]" size="4" value="<?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['year']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['year']) : (isset($this->_aVars['aForms']['year']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['year']) : '')); ?>
" id="year" maxlength="4" />
					<div class="extra_info">
<?php echo Phpfox::getPhrase('music.eg_1982'); ?>
					</div>
				</div>
			</div>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('music.description'); ?>:
				</div>
				<div class="table_right">
					<textarea cols="40" rows="6" name="val[text]" id="text" style="height:50px;"><?php $aParams = (isset($aParams) ? $aParams : Phpfox::getLib('phpfox.request')->getArray('val')); echo (isset($aParams['text']) ? Phpfox::getLib('phpfox.parse.output')->clean($aParams['text']) : (isset($this->_aVars['aForms']['text']) ? Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aForms']['text']) : '')); ?>
</textarea>
				</div>
			</div>
			
			
				<div class="table">
					<div class="table_left">
<?php echo Phpfox::getPhrase('music.photo'); ?>:
					</div>
					<div class="table_right">
<?php if ($this->_aVars['bIsEdit'] && ! empty ( $this->_aVars['aForms']['image_path'] )): ?>
						<div id="js_music_current_image">
<?php echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aForms']['server_id'],'path' => 'music.url_image','file' => $this->_aVars['aForms']['image_path'],'suffix' => '_120','max_width' => '120','max_height' => '120')); ?>
							<div class="extra_info">
<?php echo Phpfox::getPhrase('music.click_a_href_onclick_javascript_here_a_to_delete_this_image_and_upload_a_new_one_in_its_p', array('javascript' => $this->_aVars['sJavaScriptEditLink'])); ?>
							</div>
						</div>
<?php endif; ?>
						<div id="js_music_upload_image"<?php if ($this->_aVars['bIsEdit'] && ! empty ( $this->_aVars['aForms']['image_path'] )): ?> style="display:none;"<?php endif; ?>>							
							<input type="file" name="image" />
							<div class="extra_info">
<?php echo Phpfox::getPhrase('music.you_can_upload_a_jpg_gif_or_png_file'); ?>
							</div>
						</div>
					</div>
				</div>							
			
<?php if (Phpfox ::isModule('privacy')): ?>
			<div<?php if ($this->_aVars['bIsEdit'] && ! empty ( $this->_aVars['aForms']['module_id'] )): ?> style="display:none;"<?php endif; ?>>			
				<div class="table">
					<div class="table_left">
<?php echo Phpfox::getPhrase('music.privacy'); ?>:
					</div>
					<div class="table_right">	
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy','privacy_info' => 'music.control_who_can_see_this_album_and_any_songs_connected_to_it')); ?>
					</div>			
				</div>

				<div class="table">
					<div class="table_left">
<?php echo Phpfox::getPhrase('music.comment_privacy'); ?>:
					</div>
					<div class="table_right">	
<?php Phpfox::getBlock('privacy.form', array('privacy_name' => 'privacy_comment','privacy_info' => 'music.control_who_can_comment_on_this_album','privacy_no_custom' => true)); ?>
					</div>			
				</div>
			</div>
<?php endif; ?>
			
			<div class="table_clear">
				<input type="submit" value="<?php if ($this->_aVars['bIsEdit']):  echo Phpfox::getPhrase('music.update');  else:  echo Phpfox::getPhrase('music.submit');  endif; ?>" class="button" />
			</div>
		</div>		
	
</form>

	
	<form method="post" action="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('music.upload'); ?>" enctype="multipart/form-data" onsubmit="return startProcess(<?php echo $this->_aVars['sGetJsForm']; ?>, false);" id="js_album_form" target="js_upload_frame">
<?php echo '<div><input type="hidden" name="' . Phpfox::getTokenName() . '[security_token]" value="' . Phpfox::getService('log.session')->getToken() . '" /></div>'; ?>
		<div><input type="hidden" name="val[iframe]" value="1" /></div>		
		<div id="js_upload_music_track" class="page_section_menu_holder" style="display:none;">
<?php if (( ( $this->_aVars['bIsEdit'] && $this->_aVars['aForms']['user_id'] == Phpfox ::getUserId() && Phpfox ::getUserParam('music.can_edit_own_albums')) || ! $this->_aVars['bIsEdit'] )): ?>
			<div>
				<div id="js_music_upload_song">
					<?php /* Cached: May 28, 2013, 1:15 pm */  
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
				</div>
			</div>
<?php endif; ?>
		</div>
	
</form>

</div>
