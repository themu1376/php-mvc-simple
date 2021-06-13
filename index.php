<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');

    date_default_timezone_set('Asia/Seoul');
    session_start();

    define('_ROOT',dirname(__FILE__)."/");
    define('_APP',_ROOT."application/");
    define('_PUBLIC',_ROOT."public/");
    define('_MODEL',_APP."model/");
    define('_VO',_APP."vo/");
    define('_CONFIG',_APP."config/");
    define('_CONTROLLER',_APP."controller/");
    define('_VIEW',_APP."view/");
    $url = str_replace("index.php","","{$_SERVER['PHP_SELF']}");
    define('_URL',$url);
    define('_IMG',_URL.'public/img/');
    define('_CSS',_URL.'public/common/css/');
    define('_JS',_URL.'public/common/js/');
    require_once(_CONFIG."lib.php");
    new Application();