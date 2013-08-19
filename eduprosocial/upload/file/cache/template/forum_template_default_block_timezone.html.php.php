<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 28, 2013, 12:24 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: timezone.html.php 1124 2009-10-02 14:07:30Z Raymond_Benc $
 */
 
 

?>
<div class="t_center" style="margin-top:30px;">
<?php echo Phpfox::getPhrase('forum.all_times_are_gmt_time_zone_the_time_now_is_current_time', array('time_zone' => $this->_aVars['sCurrentTimeZone'],'current_time' => $this->_aVars['sCurrentSiteTime'])); ?>
</div>
