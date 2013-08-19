<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox_Module
 * @version 		$Id: phpfox.class.php 5004 2012-11-08 09:36:00Z Raymond_Benc $
 */
class Module_Pages
{
	public static $aDevelopers = array(
		array(
			'name' => 'Raymond_Benc',
			'website' => ''
		)
	);
	
	public static $aTables = array(
		'pages',
		'pages_admin',
		'pages_category',
		'pages_claim',
		'pages_design_order',
		'pages_feed',
		'pages_feed_comment',
		'pages_invite',
		'pages_login',
		'pages_perm',
		'pages_shoutbox',
		'pages_signup',
		'pages_text',
		'pages_type',
		'pages_url',
		'pages_widget',
		'pages_widget_text'
	);
	
	public static $aInstallWritable = array(
			'file/pic/pages/'
	);	
}

?>