<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: file.html.php 4447 2012-07-02 10:53:11Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
	<div id="js_video_detail"></div>
	<div id="js_video_process" style="display:none;">
		<div class="message">
			{img theme='ajax/add.gif' alt='' class='v_middle'} {phrase var='video.your_video_has_successfully_been_uploaded_please_standby_while_we_convert_your_video'}
		</div>
	</div>	
	
	<form method="post" action="{url link='video.frame'}" id="js_video_form" enctype="multipart/form-data" target="js_upload_frame">
	{if $sModule}
		<div><input type="hidden" name="val[callback_module]" value="{$sModule}" /></div>
	{/if}
	{if $iItem}
		<div><input type="hidden" name="val[callback_item_id]" value="{$iItem}" /></div>
	{/if}	
	{if PHPFOX_IS_AJAX}
		<div><input type="hidden" name="is_ajax" value="1" /></div>
	{/if}
	{if !empty($sEditorId)}
		<div><input type="hidden" name="editor_id" value="{$sEditorId}" /></div>
	{/if}	
		<div><input type="hidden" name="video_id" value="" class="js_cache_video_id" /></div>
		<div id="js_upload_inner_form">
		
			<div id="js_upload_actual_inner_form">		
				<div class="message" style="font-weight:normal;">
					<p>
						{phrase var='video.upload_copyrights_notice'}
					</p>
					<p>
						{phrase var='video.copyright_consequences_notice'}
					</p>
				</div>	
							
				<div class="main_break"></div>
				
				<div id="js_video_upload_error" style="display:none;">
					<div class="error_message" id="js_video_upload_message">
						
					</div>		
					<div class="main_break"></div>
				</div>
				
				{template file='video.block.form'}
			</div>
			
		</div>
	</form>	
	<div id="js_upload_frame"></div>