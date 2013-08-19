<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: July 23, 2013, 4:06 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: controller.html.php 64 2009-01-19 15:05:54Z Raymond_Benc $
 */
 
 

?>
<div class="video_info_box">
	<div class="video_info_box_content">
		<div class="video_info_view"><?php if ($this->_aVars['aVideo']['total_view'] == 0): ?>1<?php else:  echo number_format($this->_aVars['aVideo']['total_view']);  endif; ?></div>	

		<ul class="video_info_box_list">
			<li class="full_name first"><?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aVideo']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aVideo']['user_name'], ((empty($this->_aVars['aVideo']['user_name']) && isset($this->_aVars['aVideo']['profile_page_id'])) ? $this->_aVars['aVideo']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aVideo']['full_name'], 50, '...') . '</a></span>'; ?></li>
<?php if (count((array)$this->_aVars['aVideoDetails'])):  foreach ((array) $this->_aVars['aVideoDetails'] as $this->_aVars['sKey'] => $this->_aVars['sValue']): ?>
			<li><?php echo $this->_aVars['sValue']; ?> (<?php echo $this->_aVars['sKey']; ?>)</li>
<?php endforeach; endif; ?>
		</ul>

		<div class="video_info_box_text">
<?php echo Phpfox::getLib('phpfox.parse.output')->shorten(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aVideo']['text']), '100', 'video.view_more', true); ?>
		</div>

		<div class="video_info_box_extra">	
<?php if (count ( $this->_aVars['aVideo']['breadcrumb'] )): ?>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('video.category'); ?>:
				</div>
				<div class="table_right js_allow_video_click">
<?php if (count((array)$this->_aVars['aVideo']['breadcrumb'])):  $this->_aPhpfoxVars['iteration']['breadcrumbs'] = 0;  foreach ((array) $this->_aVars['aVideo']['breadcrumb'] as $this->_aVars['aBredcrumb']):  $this->_aPhpfoxVars['iteration']['breadcrumbs']++; ?>

<?php if ($this->_aPhpfoxVars['iteration']['breadcrumbs'] != 1): ?><div class="p_2">&raquo; <?php endif; ?>
					<a href="<?php echo $this->_aVars['aBredcrumb']['1']; ?>"><?php echo $this->_aVars['aBredcrumb']['0']; ?></a>
<?php if ($this->_aPhpfoxVars['iteration']['breadcrumbs'] != 1): ?></div><?php endif; ?>
<?php endforeach; endif; ?>
				</div>
			</div>
<?php endif; ?>

<?php if (! empty ( $this->_aVars['aVideo']['tag_list'] )): ?>
			<div class="table">
				<div class="table_left">
<?php echo Phpfox::getPhrase('video.tags'); ?>:
				</div>
				<div class="table_right js_allow_video_click">
<?php if (count((array)$this->_aVars['aVideo']['tag_list'])):  $this->_aPhpfoxVars['iteration']['tags'] = 0;  foreach ((array) $this->_aVars['aVideo']['tag_list'] as $this->_aVars['aTag']):  $this->_aPhpfoxVars['iteration']['tags']++; ?>

<?php if ($this->_aPhpfoxVars['iteration']['tags'] != 1): ?>, <?php endif; ?><a href="<?php if (isset ( $this->_aVars['sGroup'] ) && $this->_aVars['sGroup'] != ''):  echo Phpfox::getLib('phpfox.url')->makeUrl('group.'.$this->_aVars['sGroup'].'.video.tag.'.$this->_aVars['aTag']['tag_url'].'');  else:  echo Phpfox::getLib('phpfox.url')->makeUrl('video.tag.'.$this->_aVars['aTag']['tag_url'].'');  endif; ?>"><?php echo $this->_aVars['aTag']['tag_text']; ?></a>
<?php endforeach; endif; ?>
				</div>
			</div>
<?php endif; ?>
		</div>
	</div>	
	<a href="#" class="video_info_toggle">
		<span class="js_info_toggle_show_more"><?php echo Phpfox::getPhrase('video.show_more'); ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/video_show_more.png')); ?></span>
		<span class="js_info_toggle_show_less"><?php echo Phpfox::getPhrase('video.show_less'); ?> <?php echo Phpfox::getLib('phpfox.image.helper')->display(array('theme' => 'layout/video_show_less.png')); ?></span>
	</a>	
</div>
