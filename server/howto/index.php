<?php
require_once $_SERVER['DOCUMENT_ROOT'].'iia_timak/vendor/Mysql/MysqliDb.php';

// nacitanie db credentails
$credentials = include $_SERVER['DOCUMENT_ROOT'].'iia_timak/configs/database.php';
$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

var_dump($db->get('consultations'));

