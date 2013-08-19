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
 * @package 		Phpfox_Component
 * @version 		$Id: display.class.php 4177 2012-05-16 11:03:45Z Miguel_Espinoza $
 */
class Ad_Component_Block_Display extends Phpfox_Component
{	
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		if (defined('PHPFOX_IS_AJAX_PAGE') && PHPFOX_IS_AJAX_PAGE)
		{
		
		}
		
		(($sPlugin = Phpfox_Plugin::get('ad.component_block_display_process__start')) ? eval($sPlugin) : false);
		if (!Phpfox::getParam('ad.enable_ads'))
		{
			return false;
		}	
		
		if ($this->getParam('block_id') == '1' || $this->getParam('block_id') == '3')
		{
			$aDeny = array(
				'forum'				
			);			
			
			if (in_array(Phpfox::getLib('module')->getModuleName(), $aDeny))
			{
				return false;
			}		
		}		
		
		$aAds = Phpfox::getService('ad')->getForBlock($this->getParam('block_id'), true);				
		
		foreach ($aAds as $iKey => $aAd)
		{
			if (!is_array($aAd))
			{
				$aAds = array($aAds);
				break;
			}
		}
		
		$bBlockIdForAds = false;
		
		foreach ($aAds as $iKey => $aAd)
		{
			if (!empty($aAd['disallow_controller']))
			{
				$sControllerName = Phpfox::getLib('module')->getFullControllerName();
				$aParts = explode(',', $aAd['disallow_controller']);
				foreach ($aParts as $sPart)
				{
					$sPart = trim($sPart);
					if ($sControllerName == $sPart)
					{
						unset($aAds[$iKey]);
						//return false;
					}
				}
			}
			if (!empty($aAd[$iKey]['html_code']))
			{
				$aAds[$iKey]['html_code'] = str_replace('target="_blank"', 'target="_blank" class="no_ajax_link"', $aAd['html_code']);
			}
			if (PHPFOX_IS_AJAX && $this->getParam('block_id') == 'photo_theater'
				&& ($aGetRequest = $this->request()->get('core')) 
				&& isset($aGetRequest['call'])
				&& $aGetRequest['call'] == 'photo.view'
			)
			{
				$bBlockIdForAds = true;
			}
			
			if ($aAd['is_active'] != 1)
			{
				unset($aAds[$iKey]);
			}
		}
		
		if (!count($aAds))
		{			
			return false;
		}
		
		$this->template()->assign(array(
				'aBlockAds' => $aAds,
				'bBlockIdForAds' => $bBlockIdForAds,
				'iBlockId' => $this->getParam('block_id')
			)
		);		
		
		(($sPlugin = Phpfox_Plugin::get('ad.component_block_display_process__end')) ? eval($sPlugin) : false);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('ad.component_block_display_clean')) ? eval($sPlugin) : false);
	}
}

?>