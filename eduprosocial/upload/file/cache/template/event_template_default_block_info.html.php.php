<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 13, 2013, 11:05 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: info.html.php 3533 2011-11-21 14:07:21Z Raymond_Benc $
 */
 
 

?>
<div class="info_holder">

	<div class="info">
		<div class="info_left">
<?php echo Phpfox::getPhrase('event.time'); ?>
		</div>
		<div class="info_right">
<?php echo $this->_aVars['aEvent']['event_date']; ?>
		</div>
	</div>	
	
<?php if (is_array ( $this->_aVars['aEvent']['categories'] ) && count ( $this->_aVars['aEvent']['categories'] )): ?>
	<div class="info">
		<div class="info_left">
<?php echo Phpfox::getPhrase('event.category'); ?>
		</div>
		<div class="info_right">
<?php echo Phpfox::getService('core.category')->displayView($this->_aVars['aEvent']['categories']); ?>
		</div>
	</div>		
<?php endif; ?>
	
	<div class="info">
		<div class="info_left">
<?php echo Phpfox::getPhrase('event.location'); ?>
		</div>
		<div class="info_right">				 	
<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['location']), 60); ?>
<?php if (! empty ( $this->_aVars['aEvent']['address'] )): ?>
			<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['address']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aEvent']['city'] )): ?>
			<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['city']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aEvent']['postal_code'] )): ?>
			<div class="p_2"><?php echo Phpfox::getLib('phpfox.parse.output')->clean($this->_aVars['aEvent']['postal_code']); ?></div>
<?php endif; ?>
<?php if (! empty ( $this->_aVars['aEvent']['country_child_id'] )): ?>
			<div class="p_2"><?php echo Phpfox::getService('core.country')->getChild($this->_aVars['aEvent']['country_child_id']); ?></div>
<?php endif; ?>
			<div class="p_2"><?php echo Phpfox::getService('core.country')->getCountry($this->_aVars['aEvent']['country_iso']); ?></div>
<?php if (isset ( $this->_aVars['aEvent']['map_location'] )): ?>
			<div style="width:390px; height:170px; position:relative;">
				<div style="margin-left:-8px; margin-top:-8px; position:absolute; background:#fff; border:8px blue solid; width:12px; height:12px; left:50%; top:50%; z-index:200; overflow:hidden; text-indent:-1000px; border-radius:12px;">Marker</div>
				<a href="http://maps.google.com/?q=<?php echo $this->_aVars['aEvent']['map_location']; ?>" target="_blank" title="<?php echo Phpfox::getPhrase('event.view_this_on_google_maps'); ?>"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $this->_aVars['aEvent']['map_location']; ?>&amp;zoom=16&amp;size=390x170&amp;sensor=false&amp;maptype=roadmap" alt="" /></a>
			</div>		
			<div class="p_top_4">					
				<a href="http://maps.google.com/?q=<?php echo $this->_aVars['aEvent']['map_location']; ?>" target="_blank"><?php echo Phpfox::getPhrase('event.view_on_google_maps'); ?></a>
			</div>			
<?php endif; ?>
		</div>
	</div>
	
	<div class="info">
		<div class="info_left">
<?php echo Phpfox::getPhrase('event.created_by'); ?>
		</div>
		<div class="info_right">
<?php echo '<span class="user_profile_link_span" id="js_user_name_link_' . $this->_aVars['aEvent']['user_name'] . '"><a href="' . Phpfox::getLib('phpfox.url')->makeUrl('profile', array($this->_aVars['aEvent']['user_name'], ((empty($this->_aVars['aEvent']['user_name']) && isset($this->_aVars['aEvent']['profile_page_id'])) ? $this->_aVars['aEvent']['profile_page_id'] : null))) . '">' . Phpfox::getLib('phpfox.parse.output')->shorten($this->_aVars['aEvent']['full_name'], Phpfox::getParam('user.maximum_length_for_full_name')) . '</a></span>'; ?>
		</div>
	</div>

<?php echo Phpfox::getLib('phpfox.parse.output')->split(Phpfox::getLib('phpfox.parse.output')->parse($this->_aVars['aEvent']['description']), 70); ?>

</div>
