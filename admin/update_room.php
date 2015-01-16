<?php
require_once $_SERVER['DOCUMENT_ROOT'].'iia-timak/vendor/Mysql/MysqliDb.php';

// nacitanie db credentails
$credentials = include $_SERVER['DOCUMENT_ROOT'].'iia-timak/configs/database.php';
$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

    $id = ; //get id from db - co prave vidime
    $name = ; // get name from input field 
    
    
    
    $data = Array(
    'name' => $name
);

$db->where ('id', $id);

if ($db->update ('rooms', $data))
    echo $db->count . ' miestnosti bolo zmenenych';
else
    echo 'update failed: ' . $db->getLastError();

?>
