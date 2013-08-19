<?php defined('PHPFOX') or exit('NO DICE!'); ?>
<?php $aContent = array (
  1 => 
  array (
    'cron_id' => '1',
    'module_id' => 'log',
    'product_id' => 'phpfox',
    'next_run' => '1360236037',
    'last_run' => '1360232437',
    'type_id' => '2',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getLib(\'phpfox.database\')->delete(Phpfox::getT(\'log_session\'), "last_activity < \'" . ((PHPFOX_TIME - (Phpfox::getParam(\'log.active_session\') * 60))) . "\'");
',
  ),
  2 => 
  array (
    'cron_id' => '2',
    'module_id' => 'mail',
    'product_id' => 'phpfox',
    'next_run' => '1361997723',
    'last_run' => '1359405723',
    'type_id' => '3',
    'every' => '30',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'mail.process\')->cronDeleteMessages();',
  ),
  3 => 
  array (
    'cron_id' => '3',
    'module_id' => 'shoutbox',
    'product_id' => 'phpfox',
    'next_run' => '1360318837',
    'last_run' => '1360232437',
    'type_id' => '3',
    'every' => '1',
    'is_active' => '1',
    'php_code' => 'Phpfox::getService(\'shoutbox.process\')->clear(Phpfox::getParam(\'shoutbox.shoutbox_total\'));
',
  ),
); ?>