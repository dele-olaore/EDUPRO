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
 * @package  		Module_Blog
 * @version 		$Id: delete.class.php 4704 2012-09-20 12:03:15Z Raymond_Benc $
 */
class Blog_Component_Controller_Delete extends Phpfox_Component 
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{	
		Phpfox::isUser(true);		
		
		if ($iId = $this->request()->getInt('id'))
		{
			Phpfox::getService('blog.process')->deleteInline($iId);
			$this->url()->send('blog', array(), Phpfox::getPhrase('blog.blog_successfully_deleted'));
		}
	}
}

?>