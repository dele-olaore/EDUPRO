<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php /* Cached: May 31, 2013, 3:28 am */ ?>
<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: rsvp-entry.html.php 3342 2011-10-21 12:59:32Z Raymond_Benc $
 */
 
 

?>
<?php if (isset ( $this->_aVars['aEvent']['rsvp_id'] )): ?>
					<div class="feed_comment_extra">
						<a href="#" onclick="tb_show('<?php echo Phpfox::getPhrase('event.rsvp', array('phpfox_squote' => true)); ?>', $.ajaxBox('event.rsvp', 'height=130&amp;width=300&amp;id=<?php echo $this->_aVars['aEvent']['event_id'];  if ($this->_aVars['aCallback'] !== false): ?>&amp;module=<?php echo $this->_aVars['aCallback']['module']; ?>&amp;item=<?php echo $this->_aVars['aCallback']['item'];  endif; ?>')); return false;" id="js_event_rsvp_<?php echo $this->_aVars['aEvent']['event_id']; ?>">
<?php if ($this->_aVars['aEvent']['rsvp_id'] == 3): ?>
<?php echo Phpfox::getPhrase('event.not_attending'); ?>
<?php elseif ($this->_aVars['aEvent']['rsvp_id'] == 2): ?>
<?php echo Phpfox::getPhrase('event.maybe_attending'); ?>
<?php elseif ($this->_aVars['aEvent']['rsvp_id'] == 1): ?>
<?php echo Phpfox::getPhrase('event.attending'); ?>
<?php else: ?>
<?php echo Phpfox::getPhrase('event.respond'); ?>
<?php endif; ?>
						</a>
					</div>
<?php endif; ?>
