<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: June 29, 2013, 1:25 pm */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author			Raymond Benc
 * @package 		Phpfox
 * @version 		$Id: blank.html.php 3118 2011-09-16 10:51:04Z Raymond_Benc $
 */
 
 

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $this->_aVars['sLocaleDirection']; ?>" lang="<?php echo $this->_aVars['sLocaleCode']; ?>">
	<head>
		<title><?php echo $this->getTitle(); ?></title>	
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php echo $this->getHeader(); ?>
<?php endif; ?>
<?php if (isset ( $this->_aVars['sCustomHeader'] )): ?>
<?php echo $this->_aVars['sCustomHeader']; ?>
<?php endif; ?>
	</head>
	<body>
		<div id="js_body_width_frame">
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php Phpfox::getBlock('core.template-body'); ?>
<?php endif; ?>
<?php if (!$this->bIsSample): ?><div id="site_content"><?php if (isset($this->_aVars['bSearchFailed'])): ?><div class="message">Unable to find anything with your search criteria.</div><?php else:  Phpfox::getLib('phpfox.module')->getControllerTemplate();  endif; ?></div><?php endif; ?>
<?php if (! isset ( $this->_aVars['bNoIFrameHeader'] )): ?>
<?php Phpfox::getBlock('core.template-footer'); ?>
<?php endif; ?>
		</div>
	</body>
</html>
