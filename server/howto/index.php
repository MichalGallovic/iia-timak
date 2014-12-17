<?php
require '../../vendor/autoload.php';
$credentials = getDbCredentias();

$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

var_dump($db->get('subjects'));
