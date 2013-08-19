<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  'module_video' => 'Videos',
  'menu_video' => 'Videos',
  'user_setting_can_add_comment_on_video' => 'Can add comments on videos?',
  'setting_video_time_stamp' => '<title>Video Time Stamp</title><info>Video Time Stamp</info>',
  'user_setting_can_edit_own_video' => 'Can edit own video?',
  'user_setting_can_edit_other_video' => 'Can edit videos added by other users?',
  'user_setting_can_delete_own_video' => 'Can delete own video?',
  'user_setting_can_delete_other_video' => 'Can delete videos added by other users?',
  'menu_upload_a_new_video' => 'Upload/Share a Video',
  'menu_videos' => 'Videos',
  'admin_menu_add_category' => 'Add Category',
  'admin_menu_manage_categories' => 'Manage Categories',
  'setting_ffmpeg_path' => '<title>Path to FFMPEG</title><info>Path to FFMPEG</info>',
  'setting_mencoder_path' => '<title>Path to MENCODER</title><info>Path to MENCODER</info>',
  'setting_video_file_size_limit' => '<title>Video File Size Limit</title><info>File size limit in megabytes.</info>',
  'user_setting_video_file_size_limit' => 'File size limit in megabytes.',
  'setting_allow_video_uploading' => '<title>Enable Uploading of Videos</title><info>Enable this option if you would like to give users the ability to upload videos from their computer.

<b>Notice:</b> This feature requires that FFMPEG and MENCODER be installed. Once you attempt to enable this feature the script will attempt to verify if the server has all the required scripts installed.</info>',
  'user_setting_can_upload_videos' => 'Can upload videos?',
  'setting_embed_auto_play' => '<title>Auto Play (Shared Videos)</title><info>If enabled this setting will attempt to auto play shared videos (eg. Youtube). 

Note: This will only work on new videos being added.</info>',
  'user_setting_can_feature_videos' => 'Can feature videos?',
  'user_setting_can_spotlight_videos' => 'Can spotlight videos?',
  'setting_total_my_videos' => '<title>Total "More From" Videos to Display</title><info>When viewing a video we list more videos that belong to the owner of the video. Define how many videos should be displayed within this block.</info>',
  'setting_total_related_videos' => '<title>Total Related Videos to Display</title><info>Define how many related videos should be displayed when viewing a video.</info>',
  'user_setting_approve_video_before_display' => 'Should videos added by this user group be approved before they are displayed publicly?',
  'user_setting_can_approve_videos' => 'Can approve videos?',
  'user_setting_max_size_for_video_photos' => 'Max file size for photos upload in kilobits (kb).
(1000 kb = 1 mb)
For unlimited add "0" without quotes. 

<b>Notice:</b> Photos are only uploaded if we were unable to convert/import photos.',
  'setting_video_meta_keywords' => '<title>Video Meta Keywords</title><info>Meta keywords used within the video section.</info>',
  'setting_video_meta_description' => '<title>Video Meta Description</title><info>Meta description used within the video section.</info>',
  'setting_full_screen_with_youtube' => '<title>Enable Full Screen for YouTube</title><info>Enable this option to enable the "Full Screen" feature for YouTube videos.</info>',
  'setting_disable_youtube_related_videos' => '<title>Disable YouTube Related Videos</title><info>Enable this feature to disable YouTube related videos feature.</info>',
  'setting_show_share_and_upload_video_on_dashboard' => '<title>Show upload and share on Dashboard</title><info>Here you can choose whether to show just the "upload video" link, just the "share video" link or both on the dashboard.</info>',
  'unable_to_edit_this_video_as_there_is_no_video_id' => 'Unable to edit this video as there is no video ID#',
  'done' => 'Done!',
  'categories' => 'Categories',
  'sub_categories' => 'Sub-Categories',
  'video_details' => 'Video Details',
  'browse_filter' => 'Browse Filter',
  'more_from' => 'More From:',
  'videos' => 'Videos',
  'view_more' => 'View More',
  'related_videos' => 'Related Videos',
  'afooter' => 'aFooter',
  'spotlight' => 'Spotlight',
  'category_successfully_updated' => 'Category successfully updated.',
  'category_successfully_added' => 'Category successfully added.',
  'edit_a_category' => 'Edit a Category',
  'create_a_new_category' => 'Create a New Category',
  'category_order_successfully_updated' => 'Category order successfully updated.',
  'category_successfully_deleted' => 'Category successfully deleted.',
  'manage_categories' => 'Manage Categories',
  'id_must_be_defined' => 'ID must be defined.',
  'unable_to_edit_this_video' => 'Unable to edit this video',
  'video_successfully_updated' => 'Video successfully updated.',
  'edit_a_video' => 'Edit a Video',
  'upload_failed_file_is_too_large' => 'Upload failed. File is too large.',
  'video_section_is_closed' => 'Video section is closed.',
  'video_successfully_deleted' => 'Video successfully deleted.',
  'full_name_s_videos_full_name_has_total_video_s' => '{full_name}\'s videos. {full_name} has {total} video(s).',
  'full_name_s_videos' => '{full_name}\'s Videos',
  'videos_for_this_profile_is_set_to_private' => 'Videos for this profile is set to private.',
  'video_successfully_added' => 'Video successfully added.',
  'video_successfull_added_however_you_will_have_to_manually_upload_a_photo_for_it' => 'Video successfull added, however you will have to manually upload a photo for it.',
  'share_a_video' => 'Share a Video',
  'video_successfully_uploaded' => 'Video successfully uploaded.',
  'upload_a_video' => 'Upload a Video',
  'the_video_you_are_looking_for_does_not_exist_or_has_been_removed' => 'The video you are looking for does not exist or has been removed.',
  'total_rating_ratings' => '{total_rating} Ratings',
  'poor' => 'Poor',
  'nothing_special' => 'Nothing Special',
  'worth_watching' => 'Worth Watching',
  'pretty_cool' => 'Pretty Cool',
  'awesome' => 'Awesome',
  'you_have_already_voted' => 'You have already voted.',
  'you_cannot_rate_your_own_video' => 'You cannot rate your own video.',
  'select' => 'Select',
  'select_a_sub_category' => 'Select a Sub-Category',
  'nothing_to_convert' => 'Nothing to convert.',
  'started_converting_process' => 'Started converting process.',
  'converting_store_in_cache_video_id' => 'Converting (store in cache): {video_id}',
  'updated_process_id' => 'Updated process ID#',
  'start_converting_process_video_id' => 'Start converting process: {video_id}',
  'file_exists_sdestination' => 'File exists: {sDestination}',
  'cant_convert_ssource' => 'Cant convert: {sSource}',
  'converting_ssource' => 'Converting: {sSource}',
  'converting_completed_sdestination' => 'Converting completed: {sDestination}',
  'updated_database_video_table' => 'Updated database video table.',
  'updated_user_points' => 'Updated user points.',
  'removed_source_file' => 'Removed source file.',
  'completed_image_simagelocation' => 'Completed Image: {sImageLocation}',
  'completed_sdestination' => 'Completed: {sDestination}',
  'unable_to_convert_video' => 'Unable to convert video.',
  'not_a_valid_site_valid_sites_asites' => 'Not a valid site. Valid sites: {aSites}',
  'provide_a_category_this_video_will_belong_to' => 'Provide a category this video will belong to.',
  'unable_to_embed_this_video_due_to_privacy_settings' => 'Unable to embed this video due to privacy settings.',
  'select_a_video_to_upload' => 'Select a video to upload.',
  'not_a_valid_file_we_only_allow_sallow' => 'Not a valid file. We only allow: {sAllow}',
  'select_a_video' => 'Select a video.',
  'unable_to_process_this_video' => 'Unable to process this video.',
  'unable_to_find_the_video_you_plan_to_edit' => 'Unable to find the video you plan to edit.',
  'provide_a_title_for_this_video' => 'Provide a title for this video.',
  'invalid_permissions' => 'Invalid Permissions.',
  'unable_to_find_the_video_you_plan_to_delete' => 'Unable to find the video you plan to delete.',
  'unable_to_find_the_video_image_you_plan_to_delete' => 'Unable to find the video image you plan to delete.',
  'unable_to_find_the_video_you_want_to_approve' => 'Unable to find the video you want to approve.',
  'your_video_has_been_approved_on_site_title' => 'Your video has been approved on {site_title}',
  'your_video_has_been_approved_on_site_title_n_nto_view_this_video_follow_the_link_below_n_a_href' => 'Your video has been approved on {site_title}.nnTo view this video, follow the link below:n<a href="{sLink}"> {sLink} </a>',
  'not_a_valid_video_to_display' => 'Not a valid video to display.',
  'are_you_sure_this_will_delete_all_videos_that_belong_to_this_category_and_cannot_be_undone' => 'Are you sure? This will delete all videos that belong to this category and cannot be undone.',
  'added_by' => 'Added By',
  'rating' => 'Rating',
  'category' => 'Category',
  'url' => 'URL',
  'embed' => 'Embed',
  'featured' => 'Featured',
  'pending' => 'Pending',
  'approve_this_video' => 'Approve this video.',
  'approved' => 'Approved',
  'edit_this_video' => 'Edit this video.',
  'edit' => 'Edit',
  'delete_this_video' => 'Delete this video.',
  'are_you_sure' => 'Are you sure?',
  'delete' => 'Delete',
  'feature_this_video' => 'Feature this video.',
  'unfeature' => 'Unfeature',
  'spotlight_this_video' => 'Spotlight this video.',
  'remove_the_spotlight_from_this_video' => 'Remove the spotlight from this video.',
  'remove_spotlight' => 'Remove Spotlight',
  'keywords' => 'Keywords',
  'submit' => 'Submit',
  'reset' => 'Reset',
  'video_title' => 'Video Title',
  'description' => 'Description',
  'by' => 'By',
  'report_a_video' => 'Report a Video',
  'report' => 'Report',
  'add_to_your_favorites' => 'Add to your Favorites',
  'add_to_favorites' => 'Add to Favorites',
  'edit_this_video_menu' => 'Edit this Video',
  'delete_this_video_menu' => 'Delete this Video',
  'total_views_views' => '{total_views} views',
  'no_videos_have_been_added_yet' => 'No videos have been added yet.',
  'be_the_first_to_add_a_video' => 'Be the First to Add a Video.',
  'go_advanced' => 'go advanced',
  'cancel' => 'cancel',
  'no_videos_added_yet_link_to_add' => 'No videos added yet. Click <a href="{sAddNewVideoLink}"> here</a> to add a new video.',
  'update' => 'Update',
  'no_videos_added_yet' => 'No videos added yet.',
  'add_a_new_video' => 'Add a New Video',
  'video_category_details' => 'Video Category Details',
  'name' => 'Name',
  'parent_category' => 'Parent Category',
  'select_form_select' => 'Select',
  'update_order' => 'Update Order',
  'view_this_video' => 'View This Video',
  'step_2' => 'Step 2',
  'photo' => 'Photo',
  'step_1' => 'Step 1',
  'save' => 'Save',
  'video_photo' => 'Video Photo',
  'here' => 'here',
  'click_to_delete_this_image' => 'Click <a href="#" onclick="{on_delete_image}">here</a> to delete this image and upload a new one in its place.',
  'you_can_upload_a_jpg_gif_or_png_file' => 'You can upload a JPG, GIF or PNG file.',
  'the_file_size_limit_is' => 'The file size limit is {iMaxFileSize_filesize}. If your upload does not work, try uploading a smaller picture.',
  'you_have_not_added_any_videos' => 'You have not added any videos.',
  'browse_other_videos' => 'Browse Other Videos',
  'no_videos_have_been_added' => 'No videos have been added.',
  'there_is_one_video_that_is_pending_approval' => 'There is one video that is pending approval.',
  'there_are_ivideoapprovecnt_videos_that_are_pending_approval' => 'There are {iVideoApproveCnt} videos that are pending approval.',
  'click_here_to_approve_videos' => 'Click <a href="{sLinkPendingVideos}">here</a> to approve videos.',
  'video_url' => 'Video URL',
  'supported_sites' => 'Supported sites',
  'add' => 'Add',
  'add_a_video' => 'Add a Video',
  'view_your_videos' => 'View Your Videos',
  'upload_more_videos' => 'Upload More Videos',
  'uploading' => 'Uploading',
  'upload_copyrights_notice' => 'You retain all rights in your video that you upload. You must only upload videos in which you own all the rights. If you upload any videos in which you do not own all the rights, you may be violating copyright law.',
  'copyright_consequences_notice' => 'Uploading copyrighted videos without the explicit consent of the copyright owner will result in your profile being cancelled.',
  'select_video' => 'Select Video',
  'you_can_upload_a_sfileext_file' => 'You can upload a {sFileExt} file.',
  'max_file_size_iuploadlimit' => 'Max file size: {iUploadLimit}',
  'video_is_being_processed' => 'Video is being processed.',
  'video_is_pending_approval' => 'Video is pending approval.',
  'user_link_has_not_added_any_videos' => '{user_link} has not added any videos.',
  'date_added' => 'Date Added',
  'popular' => 'Popular',
  'most_discussed' => 'Most Discussed',
  'most_viewed' => 'Most Viewed',
  'recent_videos' => 'Recent Videos',
  'sort' => 'Sort',
  'in_sorting_order' => 'in',
  'manage_videos' => 'Manage Videos',
  'your_video_title_has_been_approved' => 'Your video "{title}" has been approved.',
  'view_videos' => 'View Videos',
  'a_href_user_link_owner_full_name_a_added_a_new_video_a_href_title_link_title_a' => '<a href="{user_link}">{owner_full_name}</a> added a new video "<a href="{title_link}">{title}</a>".',
  'a_href_user_link_full_name_a_added_a_new_comment_on_their_own_a_href_title_link_video_a' => '<a href="{user_link}">{full_name}</a> added a new comment on their own <a href="{title_link}">video</a>.',
  'a_href_user_link_full_name_a_added_a_new_comment_on_your_a_href_title_link_video_a' => '<a href="{user_link}">{full_name}</a> added a new comment on your <a href="{title_link}">video</a>.',
  'a_href_user_link_full_name_a_added_a_new_comment_on_a_href_item_user_link_item_user_name_s_a_a_href_title_link_video_a' => '<a href="{user_link}">{full_name}</a> added a new comment on <a href="{item_user_link}">{item_user_name}\'s</a> <a href="{title_link}">video</a>.',
  'on_name_s_video' => 'On {name}\'s video.',
  'user_name_left_you_a_comment_on_site_title' => '{user_name} left you a comment on {site_title}.',
  'user_name_left_you_a_comment_on_your_video_title' => '{user_name} left you a comment on your video "{title}".

To view this comment, follow the link below:
<a href="{link}">{link}</a>',
  'video_text' => 'Video Text',
  'added' => 'Added',
  'comments' => 'Comments',
  'view' => 'View',
  'embedding_this_video_is_not_allowed_try_another_video' => 'Embedding this video is not allowed. Try another video.',
  'full_name_wrote_a_comment_on_your_video' => '<a href="{user_link}">{full_name}</a> wrote a comment on your video "<a href="{link}">{title}</a>".',
  'un_feature_this_video' => 'Un-Feature this video.',
  'user_setting_points_video' => 'Points received when adding a video.',
  'tags' => 'Tags',
  'view_more_videos' => 'View More Videos',
  'video_added_on_time_stamp_by_full_name' => '<a href="{link}">Video</a> added on {time_stamp} by <a href="{user_link}">{full_name}</a>.',
  'update_video_view_count' => 'Update video "view" count (Only for those that upgraded from v1.6.21).',
  'total_views' => '{total} views',
  'favorite' => 'Favorite',
  'user_setting_can_access_videos' => 'Can browse and view the video module?',
  'a_href_user_link_full_name_a_likes_your_a_href_link_video_a' => '<a href="{user_link}">{full_name}</a> likes your <a href="{link}">video</a>.',
  'a_href_user_link_full_name_a_likes_their_own_a_href_link_video_a' => '<a href="{user_link}">{full_name}</a> likes {gender} own <a href="{link}">video</a>.',
  'a_href_user_link_full_name_a_likes_a_href_view_user_link_view_full_name_a_s_a_href_link_video_a' => '<a href="{user_link}">{full_name}</a> likes <a href="{view_user_link}">{view_full_name}</a>\'s <a href="{link}">video</a>.',
  'upload_videos' => 'Upload Videos',
  'update_tags_videos' => 'Update Tags (Videos)',
  '1_view' => '1 view',
  'no_videos_found' => 'No videos found.',
  'total_rating_out_of_10' => '{total_rating} out of 10',
  'rss_group_name_4' => 'Videos',
  'rss_title_5' => 'Latest Videos',
  'rss_description_5' => 'List of all the latest videos.',
  'please_provide_a_valid_url_for_your_video' => 'Please provide a valid URL for your video.',
  'user_setting_can_sponsor_video' => 'Can members of this user group mark videos as sponsor?',
  'unsponsor_this_video' => 'Unsponsor this video',
  'sponsor_this_video' => 'Sponsor this video',
  'video_successfully_sponsored' => 'Video successfully sponsored.',
  'video_successfully_un_sponsored' => 'Video successfully unsponsored.',
  'sponsored_video' => 'Sponsored Video',
  'user_setting_can_purchase_sponsor' => 'Can members of this user group purchase a sponsored ad space?',
  'sponsor_help' => 'To purchase sponsor space for your video, view your video by clicking on it and then click on "Sponsor" on the right hand side menu',
  'encourage_sponsor' => 'Sponsor your Videos',
  'user_setting_video_sponsor_price' => 'How much is the sponsor space worth?
This works in a CPM basis.',
  'sponsor_paypal_message' => 'Payment for the sponsor space of video: {sVideoTitle}',
  'sponsor_title' => 'Video: {sVideoTitle}',
  'sponsor_error_not_found' => 'The video you are trying to sponsor cannot be found.',
  'user_setting_auto_publish_sponsored_item' => 'After the user has purchased a sponsored space, should the video be published right away?
If set to false, the admin will have to approve each new purchased sponsored video space before it is shown in the site.',
  'comments_total_comment' => 'Comments ({total_comment})',
  'total_score_out_of_10' => '{total_score} out of 10',
  'user_setting_flood_control_videos' => 'How many minutes should a user wait before they can share/upload another video?

Note: Setting it to "0" (without quotes) is default and users will not have to wait.',
  'you_are_sharing_a_video_a_little_too_soon' => 'You are sharing a video a little too soon.',
  'you_are_uploading_a_video_a_little_too_soon' => 'You are uploading a video a little too soon.',
  'setting_params_for_ffmpeg' => '<title>Params for FFMPEG</title><info>This is the string to be used when converting videos using ffmpeg. 
The following replacements apply:
{source} path and file of the video to convert
{destination} path and file of the converted video
{width} frame width
{height} frame height</info>',
  'setting_params_for_mencoder' => '<title>Params for Mencoder</title><info>This is the string to be used when converting videos using mencoder.
The following replacements apply:
{source} path and file of the video to convert
{destination} path and file of the converted video
{width} frame width
{height} frame height</info>',
  'setting_params_for_mencoder_fallback' => '<title>Fallback Params for Mencoder</title><info>In case the first mencoder call fails this other param will be used in a subsequent call. The following replacements apply:
{source} path and file of the video to convert
{destination} path and file of the converted video
{width} frame width
{height} frame height</info>',
  'setting_flvtool2_path' => '<title>Path to FLVTool2</title><info>Path to FLVTool2</info>',
  'setting_params_for_flvtool2' => '<title>Params for FLVTool2</title><info>This is the string to be used when calling FLVTool2. The following replacements apply:
{source} path and file of the video to convert
{destination} path and file of the converted video
{width} frame width
{height} frame height</info>',
  'setting_enable_flvtool2' => '<title>Enable FLVTool2</title><info>Should the script call FLVTool2 after converting videos?</info>',
  'setting_close_sql_connection_while_converting' => '<title>Close SQL Connection During Conversion</title><info>Enable this option to close the SQL connection while converting videos.</info>',
  'video' => 'Video',
  'say_something_about_this_video' => 'Say something about this video...',
  'setting_video_enable_mass_uploader' => '<title>Enable Mass Uploader</title><info>When enabled users will be allowed to use SWFUpload to upload videos, this shows a progress bar for the percentage of the video that has been uploaded. 

This uses an integration of SWFUpload (http://code.google.com/p/swfupload/) and thus it uses a Flash object.</info>',
  'use_simple_uploader' => 'Use simple uploader',
  'use_mass_uploader' => 'Use mass uploader',
  'setting_allow_youtube_iframe' => '<title>Allow iFrame From Youtube</title><info>iFrames pose a security risk and are disabled by default in the script. 
If you want to allow users to embed videos from youtube you can enable iframes only for youtube here.</info>',
  'viewing_video' => 'Viewing Video',
  'title' => 'Title',
  'select_a_video_to_attach' => 'Select a video to attach.',
  'video_has_been_approved' => 'Video has been approved.',
  'video_approved' => 'Video Approved',
  'go_advanced_uppercase' => 'Go Advanced',
  'cancel_uppercase' => 'Cancel',
  'search_videos' => 'Search Videos...',
  'latest' => 'Latest',
  'most_liked' => 'Most Liked',
  'all_videos' => 'All Videos',
  'my_videos' => 'My Videos',
  'friends_videos' => 'Friends\' Videos',
  'featured_videos' => 'Featured Videos',
  'topic' => 'Topic',
  'approve' => 'Approve',
  'your_video_has_successfully_been_uploaded_please_standby_while_we_convert_your_video' => 'Your video has successfully been uploaded. Please standby while we convert your video.',
  'upload_problems_try_the_basic_uploader' => 'Upload problems? Try the <a href="{link}">basic uploader</a> (works on older computers and web browsers).',
  'upload' => 'Upload',
  'click_here_to_view_a_list_of_supported_sites' => 'Click <a href="#" onclick="$Core.box(\'video.supportedSites\', 600); return false;">here</a> to view a list of supported sites you can import videos from.',
  'privacy' => 'Privacy',
  'control_who_can_see_this_video' => 'Control who can see this video.',
  'comment_privacy' => 'Comment Privacy',
  'control_who_can_comment_on_this_video' => 'Control who can comment on this video.',
  'link' => 'Link',
  'un_sponsor' => 'Un-Sponsor',
  'sponsor' => 'Sponsor',
  'feature' => 'Feature',
  'un_feature' => 'Un-Feature',
  'sponsored' => 'Sponsored',
  'moderate' => 'Moderate',
  'by_full_name' => 'by {full_name}',
  'actions' => 'Actions',
  'show_more' => 'Show More',
  'show_less' => 'Show Less',
  'report_this_video' => 'Report this video',
  'unable_to_view_this_item_due_to_privacy_settings' => 'Unable to view this item due to privacy settings.',
  'editing_video' => 'Editing Video',
  'full_name_liked_your_video_title' => '{full_name} liked your video "{title}"',
  'full_name_liked_your_video_message' => '{full_name} liked your video "<a href="{link}">{title}</a>"
To view this video follow the link below:
<a href="{link}">{link}</a>',
  'by_lowercase' => 'by',
  'views' => 'views',
  'upload_share_a_video' => 'Upload/Share a Video',
  'paste_url' => 'Paste URL',
  'file_upload' => 'File Upload',
  'who_can_share_videos' => 'Who can share videos?',
  'who_can_view_browse_videos' => 'Who can view/browse videos?',
  'update_user_video_count' => 'Update User Video Count',
  'full_name_commented_on_your_video_title' => '{full_name} commented on your video "{title}".',
  'unable_to_post_a_comment_on_this_item_due_to_privacy_settings' => 'Unable to post a comment on this item due to privacy settings.',
  'posted_a_comment_on_gender_video' => 'posted a comment on {gender} video',
  'posted_a_comment_on_user_name_s_video' => 'posted a comment on {user_name}\'s video',
  'full_name_commented_on_your_video_a_href_link_title_a_to_see_the_comment_thread_follow_the_link_below_a_href_link_link_a' => '{full_name} commented on your video "<a href="{link}">{title}</a>".
To see the comment thread, follow the link below:
<a href="{link}">{link}</a>',
  'full_name_commented_on_gender_video' => '{full_name} commented on {gender} video.',
  'full_name_commented_on_other_full_name_s_video' => '{full_name} commented on {other_full_name}\'s video.',
  'full_name_commented_on_gender_video_a_href_link_title_a_to_see_the_comment_thread_follow_the_link_below_a_href_link_link_a' => '{full_name} commented on {gender} video "<a href="{link}">{title}</a>".
To see the comment thread, follow the link below:
<a href="{link}">{link}</a>',
  'full_name_commented_on_other_full_name_s_video_a_href_link_title_a_to_see_the_comment_thread_follow_the_link_below_a_href_link_link_a' => '{full_name} commented on {other_full_name}\'s video "<a href="{link}">{title}</a>.
To see the comment thread, follow the link below:
<a href="{link}">{link}</a>',
  'user_name_liked_gender_own_video_title' => '{user_name} liked {gender} own video "{title}"',
  'user_name_liked_your_video_title' => '{user_name} liked your video "{title}"',
  'user_name_liked_span_class_drop_data_user_full_name_s_span_video_title' => '{user_name} liked <span class="drop_data_user">{full_name}\'s</span> video "{title}"',
  'user_name_commented_on_gender_video_title' => '{user_name} commented on {gender} video "{title}"',
  'user_name_commented_on_your_video_title' => '{user_name} commented on your video "{title}"',
  'user_name_commented_on_span_class_drop_data_user_full_name_s_span_video_title' => '{user_name} commented on <span class="drop_data_user">{full_name}\'s</span> video "{title}"',
  'span_no_more_suggestions_found_span' => '<span>No more suggestions found</span>',
  'video_s_successfully_approved' => 'Video(s) successfully approved.',
  'video_s_successfully_deleted' => 'Video(s) successfully deleted.',
  'suggestions' => 'Suggestions',
  'load_more_suggestions' => 'Load More Suggestions',
  'user_setting_can_feature_videos_' => 'Can feature videos?',
  'can_feature_videos' => 'Can feature videos?',
  'setting_group_embedly' => '<title>Embed.ly</title><info>Embedly provides a powerful API to convert standard URLs into embedded videos and images.</info>',
  'setting_enabled_embedly_import' => '<title>Enable Embed.ly Support</title><info><a href="http://embed.ly/" target="_blank">Embedly</a> provides a powerful API to convert standard URLs into embedded videos, images, and rich article previews from 218 leading providers.</info>',
  'setting_embedly_api_key' => '<title>Embed.ly API Key</title><info>Enter your API key here.</info>',
  'user_name_tagged_you_in_a_comment_in_a_video' => '{user_name} tagged you in a comment in a video',
  'menu_video_videos_532c28d5412dd75bf975fb951c740a30' => 'Videos',
  'converting_video' => 'Converting Video',
  'setting_vidly_support' => '<title>Enable Vid.ly Support</title><info>Set to <b>True</b> to enable <a href="http://vid.ly" target="_blank">Vid.ly</a> support.</info>',
  'setting_video_upload_private_key' => '<title>Video Upload Private Key</title><info>Enter your video upload private key here.</info>',
  'setting_video_upload_public_key' => '<title>Video Upload Public Key</title><info>Enter your video upload public key here.</info>',
  'setting_video_upload_service' => '<title>Video Upload Service</title><info>Enable this option if you have our video upload service.</info>',
  'setting_vidly_user_key' => '<title>Vid.ly User Key</title><info>Enter your Vid.ly User Key here.</info>',
  'setting_vidly_api_key' => '<title>Vid.ly API key</title><info>Enter your Vid.ly API key here.</info>',
  'not_a_valid_video_site_url' => 'Not a valid video site URL.',
  'setting_group_vidly' => '<title>Vid.ly</title><info>Settings for vid.ly.</info>',
  'the_php_function_exec_is_disabled_and_needed_to_run_this_check_and_convert_uploaded_videos' => 'The PHP function "exec" is disabled and needed to run this check and convert uploaded videos',
  'must_set_the_path_to_ffmpeg_before_enabling_uploading_of_videos' => 'Must set the path to FFMPEG before enabling uploading of videos.',
); ?>