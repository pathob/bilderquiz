<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require_once(realpath('core/class.restapi.php'));
// require_once(realpath('core/lib.xml.php'));

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $api = new RestAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $api->processRequest();
} catch (Exception $e) {
    echo json_encode(Array('Error' => $e->getMessage()));
}
