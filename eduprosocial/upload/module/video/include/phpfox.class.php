<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_Video
 * @version 		$Id: phpfox.class.php 4440 2012-07-01 19:31:35Z Raymond_Benc $
 */
class Module_Video
{	
	public static $aTables = array(
		'video',
		'video_category',
		'video_category_data',
		'video_embed',
		'video_rating',
		'video_text',
		'video_track',
		'vidly',
		'vidly_url'
	);
	
	public static $aInstallWritable = array(
		'file/video/',
		'file/pic/video/'
	);
}

?>