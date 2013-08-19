<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 12:19 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: albums.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

 if (count ( $this->_aVars['aAlbums'] )):  if (count((array)$this->_aVars['aAlbums'])):  $this->_aPhpfoxVars['iteration']['albums'] = 0;  foreach ((array) $this->_aVars['aAlbums'] as $this->_aVars['aAlbum']):  $this->_aPhpfoxVars['iteration']['albums']++; ?>

	<?php /* Cached: May 28, 2013, 12:19 pm */  
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Photo
 * @version 		$Id: album-entry.html.php 4660 2012-09-18 08:32:10Z Raymond_Benc $
 */
 
 

?>
<div class="t_center photo_row" id="js_photo_album_id_<?php echo $this->_aVars['aAlbum']['album_id']; ?>">
	<div class="js_outer_photo_div js_mp_fix_holder photo_row_holder">	
		<div class="photo_row_height image_hover_holder">
<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
			<div class="photo_clip_holder_main">
<?php endif; ?>

<?php if (( $this->_aVars['aAlbum']['profile_id'] == '0' && ( ( Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id'] && Phpfox ::getUserParam('photo.can_delete_own_photo_album')) || Phpfox ::getUserParam('photo.can_delete_other_photo_albums'))) || ( $this->_aVars['aAlbum']['profile_id'] == '0' && Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id'] ) || ( ( Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id'] && Phpfox ::getUserParam('photo.can_edit_own_photo_album')) || Phpfox ::getUserParam('photo.can_edit_other_photo_albums'))): ?>
				<a href="#" class="image_hover_menu_link"><?php echo Phpfox::getPhrase('photo.link'); ?></a>				
				<div class="image_hover_menu">
					<ul>
<?php if ($this->_aVars['aAlbum']['profile_id'] == '0' && ( ( Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id'] && Phpfox ::getUserParam('photo.can_delete_own_photo_album')) || Phpfox ::getUserParam('photo.can_delete_other_photo_albums'))): ?>
						<li class="item_delete"><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo.albums', array('delete' => $this->_aVars['aAlbum']['album_id'])); ?>" id="js_delete_this_album" class="sJsConfirm"><?php echo Phpfox::getPhrase('photo.delete'); ?></a></li>
<?php endif; ?>
<?php if ($this->_aVars['aAlbum']['profile_id'] == '0' && Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id']): ?>
						<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo.add', array('album' => $this->_aVars['aAlbum']['album_id'])); ?>"><?php echo Phpfox::getPhrase('photo.upload_photo_s'); ?></a></li>
<?php endif; ?>
<?php if (( Phpfox ::getUserId() == $this->_aVars['aAlbum']['user_id'] && Phpfox ::getUserParam('photo.can_edit_own_photo_album')) || Phpfox ::getUserParam('photo.can_edit_other_photo_albums')): ?>
						<li><a href="<?php echo Phpfox::getLib('phpfox.url')->makeUrl('photo.edit-album', array('id' => $this->_aVars['aAlbum']['album_id'])); ?>" id="js_edit_this_album"><?php echo Phpfox::getPhrase('photo.edit'); ?></a></li>
<?php endif; ?>
					</ul>
				</div>
<?php endif; ?>

<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
				<div class="photo_clip_holder_border">
					<a href="<?php echo $this->_aVars['aAlbum']['link']; ?>" style="background:url('<?php if (Phpfox ::isMobile()):  echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aAlbum']['destination'],'suffix' => '_75','max_width' => 75,'max_height' => 75,'return_url' => true)); ?> <?php else:  echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aAlbum']['destination'],'suffix' => '_240','max_width' => 240,'max_height' => 240,'return_url' => true));  endif; ?>') no-repeat;" class="photo_clip_holder"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']), 45, '...'), 20); ?></a>
				</div>			
<?php else: ?>
				<a href="<?php echo $this->_aVars['aAlbum']['link']; ?>" title="<?php echo Phpfox::getPhrase('photo.name_by_full_name', array('name' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']),'full_name' => Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['full_name']))); ?>" id="js_album_inner_title_link_<?php echo $this->_aVars['aAlbum']['album_id']; ?>"><?php if (Phpfox ::isMobile()):  echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aAlbum']['destination'],'suffix' => '_75','max_width' => 75,'max_height' => 75,'title' => $this->_aVars['aAlbum']['name'],'class' => 'js_mp_fix_width'));  else:  echo Phpfox::getLib('phpfox.image.helper')->display(array('server_id' => $this->_aVars['aAlbum']['server_id'],'path' => 'photo.url_photo','file' => $this->_aVars['aAlbum']['destination'],'suffix' => '_150','max_width' => 150,'max_height' => 150,'title' => $this->_aVars['aAlbum']['name'],'class' => 'js_mp_fix_width'));  endif; ?></a>
<?php endif; ?>
<?php if (Phpfox ::getParam('photo.auto_crop_photo')): ?>
			</div>
<?php endif; ?>
		</div>
		
			<div class="photo_row_info photo_row_info_album">
				<a href="<?php echo Phpfox::permalink('photo.album', $this->_aVars['aAlbum']['album_id'], $this->_aVars['aAlbum']['name'], false, null, (array) array (
)); ?>" id="js_album_inner_title_<?php echo $this->_aVars['aAlbum']['album_id']; ?>" class="row_sub_link"><?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aAlbum']['name']), 150, '...'), 40); ?></a>
<?php if (! defined ( 'PHPFOX_IS_USER_PROFILE' )): ?>
				<div class="extra_info">				
<?php echo Phpfox::getPhrase('photo.by_lowercase'); ?> <?php echo Phpfox::getLib('phpfox.parse.output')->split('<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aAlbum']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aAlbum']['user_name'], ((empty($this->_aVars['aAlbum']['user_name']) && isset($this->_aVars['aAlbum']['profile_page_id'])) ? $this->_aVars['aAlbum']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aAlbum']['full_name'], 50, '...') . '</a></span>', 10); ?>
<?php (($sPlugin = Phpfox_Plugin::get('photo.template_block_album_entry_extra_info')) ? eval($sPlugin) : false); ?>
				</div>		
<?php endif; ?>
			</div>						
		
	</div>
</div>			
<?php if (is_int ( $this->_aPhpfoxVars['iteration']['albums'] / 3 ) || Phpfox ::isMobile()): ?>
<div class="clear"></div>
<?php endif;  endforeach; endif; ?>
<div class="clear"></div>
<?php if (!isset($this->_aVars['aPager'])): Phpfox::getLib('pager')->set(array('page' => Phpfox::getLib('request')->getInt('page'), 'size' => Phpfox::getLib('search')->getDisplay(), 'count' => Phpfox::getLib('search')->getCount())); endif;  $this->getLayout('pager');  else: ?>
<div class="extra_info">
<?php echo Phpfox::getPhrase('photo.no_albums_found_here'); ?>
</div>
<?php endif; ?>
