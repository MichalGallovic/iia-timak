<?php
require_once 'MyApi.php';
error_reporting(E_ERROR);


// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    $retArr = $API->processAPI();
    //$retStr = json_encode($retArr);
    header('Content-Type: application/json');
    echo $retArr;
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>

