<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  'module_quiz' => 'Quizzes',
  'menu_quiz' => 'Quizzes',
  'menu_add_new_quiz' => 'Add New Quiz',
  'setting_quizzes_to_show' => '<title>Quizzes to show</title><info>How many quizzes to show on the main page of the quizzes section</info>',
  'setting_quiz_view_time_stamp' => '<title>Quiz Time Stamp</title><info>This is the format used to display dates, it complies with http://php.net/date</info>',
  'setting_default_answers_count' => '<title>How Many Answers Per Default</title><info>When adding a new question in a quiz how many answer fields to show</info>',
  'user_setting_max_questions' => 'How many questions can a new Quiz (created by a member of this user group) have.',
  'user_setting_min_questions' => 'How many questions is the least a Quiz (created by members of this user group) can have.',
  'user_setting_max_answers' => 'How many answers maximum can each question in a quiz have',
  'user_setting_min_answers' => 'How many answers (minimum) can a question in a quiz have?',
  'user_setting_can_answer_own_quiz' => 'Can users answer their own quizzes?',
  'user_setting_can_approve_quizzes' => 'Are members of this group able to approve quizzes',
  'user_setting_can_delete_others_quizzes' => 'Can members of this user group delete other people\'s quizzes',
  'user_setting_new_quizzes_need_moderation' => 'Do quizzes from user group need to be moderated before being shown?',
  'user_setting_can_delete_own_quiz' => 'Allow users from this user group to delete their own quizzes?',
  'setting_show_percentage_in_track' => '<title>Show success as percentage in Tracker</title><info>In the block "Recently Taken By" set this to true if you want the success of each user to be shown as a percentage:
75%

If you set it to false it will be shown as correct vs total answers:
3/4</info>',
  'setting_show_percentage_in_results' => '<title>Show success as percentage in Results</title><info>When viewing "Users Results" if you set this to true you will see results as a percentage:
75%

If you set it to false you will see results as correct vs total:
3/4</info>',
  'user_setting_can_post_comment_on_quiz' => 'Can members of this user group post comments on quizzes?',
  'user_setting_can_edit_own_questions' => 'This setting tells if members of this user group can edit questions and answers in their own quizzes.',
  'user_setting_can_edit_others_questions' => 'This setting tells if users of this user group can edit the questions and answers in quizzes made by other users.',
  'user_setting_can_edit_own_title' => 'This setting tells if members of this user group can edit the title, description and privacy settings in quizzes they posted.',
  'user_setting_can_edit_others_title' => 'This setting tells if members of this user group can edit the title, description and privacy settings in quizzes posted by other members.',
  'user_setting_points_quiz' => 'How many points to award per new quiz.',
  'setting_takers_to_show' => '<title>Recent Takers To Show</title><info>On the "Recently Taken By" box, when viewing the results of one specific quiz, how many results do you want to show?</info>',
  'user_setting_can_view_results_before_answering' => 'If this option is enabled members of this user group will be able to view what other users answered in a quiz before they answer the quiz themselves.',
  'user_setting_can_upload_picture' => 'Can members of this user group upload a picture along with the quiz?',
  'user_setting_is_picture_upload_required' => 'Is it a requirement to upload a picture with the quiz?

Be careful as this setting along with the "quiz.can_upload_picture" could keep members from uploading any quiz (having is_picture_upload_required enabled but can_upload_picture disabled would render a useless add quiz page because of the mutual exclusion)',
  'setting_quiz_max_image_pic_size' => '<title>Size of Uploaded Picture</title><info>When users upload an image with their quizzes this will be the maximum size for that picture, anything bigger will be resized.</info>',
  'setting_quiz_meta_keywords' => '<title>Quiz Meta Keywords</title><info>Meta keywords used within quiz related sections.</info>',
  'setting_quiz_meta_description' => '<title>Quiz Meta Description</title><info>Meta description used for quiz related sections.</info>',
  'menu_profile_quiz' => 'Quizzes',
  'an_error_occured_and_your_image_could_not_be_deleted_please_try_again' => 'An error occurred and your image could not be deleted. Please try again.',
  'quiz_approved' => 'Quiz Approved',
  'an_error_kept_the_system_from_approving_the_quiz_please_try_again' => 'An error kept the system from approving the quiz, please try again.',
  'your_membership_does_not_allow_you_to_delete_this_quiz' => 'Your membership does not allow you to delete this quiz.',
  'recently_taken_by' => 'Recently Taken By',
  'view_more' => 'View More',
  'that_quiz_does_not_exist_or_its_awaiting_moderation' => 'That quiz does not exist or its awaiting moderation.',
  'your_quiz_has_been_edited' => 'Your quiz has been edited.',
  'edit_quiz' => 'Edit Quiz',
  'add_new_quiz' => 'Add New Quiz',
  'you_need_to_write_a_title' => 'You need to write a title.',
  'you_need_to_write_a_description' => 'You need to write a description.',
  'do_you_want_to_allow_comments' => 'Do you want to allow comments?',
  'is_this_quiz_public_for_friends_only_or_a_specific_list_of_members' => 'Is this quiz public, for friends only or a specific list of members?',
  'your_quiz_has_been_added_it_needs_to_be_approved_by_our_staff_before_it_can_be_shown' => 'Your quiz has been added. It needs to be approved by our staff before it can be shown.',
  'your_quiz_has_been_added' => 'Your quiz has been added.',
  'there_was_an_error_with_your_quiz_please_try_again' => 'There was an error with your quiz, please try again.',
  'you_are_not_allowed_to_edit_this_quiz' => 'You are not allowed to edit this quiz.',
  'full_name_s_quizzes' => '{full_name}\'s Quizzes',
  'quizzes' => 'Quizzes',
  'you_have_already_answered_this_quiz' => 'You have already answered this quiz.',
  'you_have_to_answer_the_questions_if_you_want_to_do_that' => 'You have to answer the questions if you want to do that.',
  'you_are_not_allowed_to_answer_your_own_quiz' => 'You are not allowed to answer your own quiz.',
  'your_answers_have_been_submitted_and_your_score_is_score' => 'Your answers have been submitted and your score is {score}%',
  'you_need_to_answer_the_quiz_before_looking_at_the_results' => 'You need to answer the quiz before looking at the results.',
  'full_name_s_quiz_from_time_stamp_title' => '{full_name}\'s quiz from {time_stamp}: {title}.',
  'a_href_user_link_full_name_a_added_a_new_quiz_a_href_question_url_question_a' => '<a href="{user_link}">{full_name}</a> added a new quiz "<a href="{question_url}">{question}</a>".',
  'a_href_user_link_full_name_a_added_a_new_comment_on_their_own_a_href_title_link_quiz_a' => '<a href="{user_link}">{full_name}</a> added a new comment on their own <a href="{title_link}">quiz</a>.',
  'a_href_user_link_full_name_a_added_a_new_comment_on_your_a_href_title_link_quiz_a' => '<a href="{user_link}">{full_name}</a> added a new comment on your <a href="{title_link}">quiz</a>.',
  'a_href_user_link_full_name_a_added_a_new_comment_on_a_href_item_user_link_item_user_name_s_a_a_href_title_link_quiz_a' => '<a href="{user_link}">{full_name}</a> added a new comment on <a href="{item_user_link}">{item_user_name}\'s</a> <a href="{title_link}">quiz</a>.',
  'full_name_approved_your_comment_on_site_title' => '{full_name} approved your comment on {site_title}.',
  'full_name_approved_your_comment_on_site_title_message' => '{full_name} approved your comment on {site_title}.

To view this comment, follow the link below:
<a href="{link}">{link}</a>',
  'user_name_left_you_a_comment_on_site_title' => '{user_name} left you a comment on {site_title}.',
  'user_name_left_you_a_comment_on_site_title_message' => '{user_name} left you a comment on {site_title}.

To view this comment, follow the link below:
<a href="{link}">{link}</a>',
  'user_name_left_you_a_comment_on_site_title_however_before_it_can_be_displayed_it_needs_to_be_approved_by_you_you_can_approve_or_deny_this_comment_by_following_the_link_below_a_href_link_link_a' => '{user_name} left you a comment on {site_title}, however before it can be displayed it needs to be approved by you.

You can approve or deny this comment by following the link below:
<a href="{link}">{link}</a>',
  'on_name_s_quiz' => 'On {name}\'s quiz.',
  'create_a_quiz' => 'Create a Quiz',
  'manage_quizzes' => 'Manage Quizzes',
  'you_cannot_answer_a_quiz_that_has_not_been_approved' => 'You cannot answer a quiz that has not been approved.',
  'you_need_to_answer_every_question' => 'You need to answer every question.',
  'you_cannot_answer_your_own_quiz' => 'You cannot answer your own quiz.',
  'you_do_not_have_the_permission_to_edit_this_quiz' => 'You do not have the permission to edit this quiz.',
  'answer' => 'Answer',
  'we_do_not_allow_empty_answers' => 'We do not allow empty answers.',
  'we_do_not_allow_default_answers_answer' => 'We do not allow default answers ({answer}).',
  'the_question_field_cannot_be_empty' => 'The question field cannot be empty.',
  'you_need_to_set_at_least_one_correct_answer_per_question' => 'You need to set at least one correct answer per question.',
  'you_need_to_add_a_minimum_of_min_and_a_maximum_of_max_questions_per_quiz_you_submitted_total' => 'You need to add a minimum of {min} and a maximum of {max} questions per quiz. You submitted {total}.',
  'you_need_to_add_a_minimum_of_2_answers_in_each_question' => 'You need to add a minimum of 2 answers in each question.',
  'not_answered' => 'Not answered',
  'you_have_reached_the_maximum_questions_allowed_per_quiz' => 'You have reached the maximum questions allowed per quiz.',
  'you_are_required_a_minimum_of_total_questions' => 'You are required a minimum of {total} questions.',
  'you_have_reached_the_maximum_answers_allowed_per_question' => 'You have reached the maximum answers allowed per question.',
  'you_are_required_a_minimum_of_total_answers_per_question' => 'You are required a minimum of {total} answers per question.',
  'are_you_sure' => 'Are you sure?',
  'delete' => 'Delete',
  'are_you_sure_you_want_to_delete_this_quiz' => 'Are you sure you want to delete this quiz?',
  'quiz_created_on_time_stamp_by_user_info' => 'Quiz created on {time_stamp} by {user_info}.',
  'quiz_created_on_time_stamp' => 'Quiz created on {time_stamp}.',
  'this_quiz_is_awaiting_moderation' => 'This quiz is awaiting moderation.',
  'view' => 'View',
  'be_the_first_to_answer_this_quiz' => 'Be the first to answer this quiz',
  'submit_your_answers' => 'Submit Your Answers',
  'approve' => 'Approve',
  'results' => 'Results',
  'take' => 'Take',
  'edit' => 'Edit',
  'question' => 'Question',
  'quiz_results_percentage_100' => 'Quiz Results ({percentage}/100)',
  'quiz_results_for_full_name_percentage_100' => 'Quiz Results for {full_name} ({percentage}/100)',
  'full_name_s_answer' => '{full_name}\'s answer',
  'correct_answer' => 'Correct Answer',
  'title' => 'Title',
  'description' => 'Description',
  '255_character_limit' => '255 character limit.',
  'quiz_questions' => 'Quiz Questions',
  'submit' => 'Submit',
  'add_another_question' => 'Add Another Question',
  'additional_options' => 'Additional Options',
  'image' => 'Image',
  'click_here_to_delete_this_image_and_upload_a_new_one_in_its_place' => 'Click here to delete this image and upload a new one in its place.',
  'you_can_upload_a_jpg_gif_or_png_file' => 'You can upload a JPG, GIF or PNG file.',
  'comments' => 'Comments',
  'allow_comments' => 'Allow Comments',
  'moderate_comments_first' => 'Moderate Comments First',
  'no_comments' => 'No Comments',
  'privacy' => 'Privacy',
  'public_quiz_will_be_added_to_our_public_quiz_section' => 'Public (quiz will be added to our public quiz section)',
  'personal_quiz_will_only_be_displayed_on_your_profile' => 'Personal (quiz will only be displayed on your profile)',
  'friends_only_friends_can_view_this_quiz' => 'Friends (Only friends can view this quiz)',
  'preferred_list_only_the_people_you_select_will_be_able_to_see_the_quiz' => 'Preferred list (only the people you select will be able to see the quiz)',
  'you_have_not_added_any_quizzes' => 'You have not added any quizzes.',
  'no_quizzes_have_been_added_yet' => 'No quizzes have been added yet.',
  'add_your_quizzes_here' => 'Add your quizzes here.',
  'be_the_first_to_add_a_quiz' => 'Be the first to add a quiz',
  'the_link_that_brought_you_here_is_wrong' => 'The link that brought you here is wrong.',
  'click_here_to_get_the_quiz_from_the_real_owner' => 'Click here to get the quiz from the real owner.',
  'unable_to_load_rating_callback' => 'Unable to load rating callback.',
  'not_a_valid_post' => 'Not a valid POST.',
  'user_info_has_not_added_any_quizzes_yet' => '{user_info} has not added any quizzes yet.',
  'quiz_successfully_deleted' => 'Quiz successfully deleted.',
  'question_count' => 'Question {count}',
  'answer_count' => 'Answer {count}...',
  'answers' => 'Answers',
  'taken_on_time_stamp' => 'Taken on {time_stamp}.',
  'users_results' => 'User Results',
  'add' => 'Add',
  'accept' => 'Accept',
  'user_setting_can_access_quiz' => 'Can browse and view the quiz module?',
  'user_setting_can_create_quiz' => 'Can create a quiz?',
  'a_href_user_link_full_name_a_likes_your_a_href_link_quiz_a' => '<a href="{user_link}">{full_name}</a> likes your <a href="{link}">quiz</a>.',
  'a_href_user_link_full_name_a_liked_their_own_a_href_link_quiz_a' => '<a href="{user_link}">{full_name}</a> likes their own <a href="{link}">quiz</a>.',
  'a_href_user_link_full_name_a_liked_a_href_view_user_link_view_full_name_a_s_a_href_link_quiz_a' => '<a href="{user_link}">{full_name}</a> likes <a href="{view_user_link}">{view_full_name}</a>\'s <a href="{link}">quiz</a>.',
  'user_setting_flood_control_quiz' => 'How many minutes should a user wait before they can create another quiz?

Note: Setting it to "0" (without quotes) is default and users will not have to wait.',
  'you_are_creating_a_quiz_a_little_too_soon' => 'You are creating a quiz a little too soon.',
  'quiz_has_been_approved' => 'Quiz has been approved.',
  'no_quizzes_found' => 'No quizzes found.',
  'search_quizzes' => 'Search Quizzes...',
  'latest' => 'Latest',
  'most_viewed' => 'Most Viewed',
  'most_liked' => 'Most Liked',
  'most_discussed' => 'Most Discussed',
  'all_quizzes' => 'All Quizzes',
  'my_quizzes' => 'My Quizzes',
  'friends_quizzes' => 'Friends\' Quizzes',
  'pending_quizzes' => 'Pending Quizzes',
  'report_this_quiz' => 'Report this quiz',
  'view_quiz' => 'View Quiz',
  'control_who_can_see_this_quiz' => 'Control who can see this quiz.',
  'comment_privacy' => 'Comment Privacy',
  'control_who_can_comment_on_this_quiz' => 'Control who can comment on this quiz.',
  'update' => 'Update',
  'by' => 'by',
  'actions' => 'Actions',
  'moderate' => 'Moderate',
  'view_results' => 'View Results',
  'full_name_liked_your_quiz_title' => '{full_name} liked your quiz "{title}"',
  'full_name_liked_your_quiz_message' => '{full_name} liked your quiz "<a href="{link}">{title}</a>"
To view this quiz follow the link below:
<a href="{link}">{link}</a>',
  'full_name_commented_on_one_of_your_quiz_title' => '{full_name} commented on one of your quizzes "{title}".',
  'unable_to_post_a_comment_on_this_item_due_to_privacy_settings' => 'Unable to post a comment on this item due to privacy settings.',
  'posted_a_comment_on_gender_quiz_a_href_link_title_a' => 'posted a comment on {gender} quiz "<a href="{link}">{title}</a>".',
  'user_name_liked_span_class_drop_data_user_full_name_s_span_quiz_title' => '{user_name} liked <span class="drop_data_user">{full_name}\'s</span> quiz "{title}"',
  'your_quiz_title_has_been_approved' => 'Your quiz "{title}" has been approved.',
  'quiz_zes_successfully_approved' => 'Quiz(zes) successfully approved.',
  'quiz_zes_successfully_deleted' => 'Quiz(zes) successfully deleted.',
  'full_name_commented_on_gender_quiz' => '{full_name} commented on {gender} quiz.',
  'full_name_commented_on_other' => '{full_name} commented on {other_full_name}\'s quiz.',
  'full_name_commented_on_other_full_name_s_quiz' => '{full_name} commented on {other_full_name}\'s quiz "<a href="{link}">{title}</a>".
To see the comment thread, follow the link below:
<a href="{link}">{link}</a>',
  'full_name_commented_on_your_quiz_a_href' => '{full_name} commented on your quiz "<a href="{link}">{title}</a>".
To see the comment thread, follow the link below:
<a href="{link}">{link}</a>',
  'posted_a_comment_user_quiz' => 'posted a comment on {user_name}\'s quiz "<a href="{link}">{title}</a>"',
  'user_names_commented_on_quiz' => '{user_names} commented on {gender} quiz "{title}"',
  'user_names_commented_on_your' => '{user_names} commented on your quiz "{title}"',
  'user_names_commented_full_name' => '{user_names} commented on <span class="drop_data_user">{full_name}\'s</span> quiz "{title}"',
  'user_name_liked_gender_own_quiz_title' => '{user_name} liked {gender} own quiz "{title}".',
  'user_name_liked_your_quiz_title' => '{user_name} liked your quiz "{title}".',
  'user_name_tagged_you_in_a_comment_in_a_quiz' => '{user_name} tagged you in a comment in a quiz',
  'menu_quiz_quizzes_532c28d5412dd75bf975fb951c740a30' => 'Quizzes',
); ?>