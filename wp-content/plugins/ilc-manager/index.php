<?php

ini_set('display_errors', 1);

require_once '../../../wp-load.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)).DS);
define('APP_PATH', ROOT.'application'.DS);

require_once ROOT.'../../../vendor/autoload.php';

try {
    require_once APP_PATH.'Autoload.php';
    require_once APP_PATH.'Config.php';

    $registry = Registry::getInstance();
    $registry->request = new Request();

    Bootstrap::run($registry->request);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
