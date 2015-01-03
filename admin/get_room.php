<?php
require_once $_SERVER['DOCUMENT_ROOT'].'iia-timak/vendor/Mysql/MysqliDb.php';

// nacitanie db credentails
$credentials = include $_SERVER['DOCUMENT_ROOT'].'iia-timak/configs/database.php';
$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

//var_dump($db->get('rooms'));

    $id = ; // get id
    
    $db->where ("id", $id);

    $user = $db->getOne ("rooms");
    echo $user['id'];
    
    $stats = $db->getOne ("rooms", "sum(id), count(*) as cnt");
     echo "total ".$stats['cnt']. "rooms found";


?>
