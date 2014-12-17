<?php
require_once $_SERVER['DOCUMENT_ROOT'].'iia-timak/vendor/Mysql/MysqliDb.php';

// nacitanie db credentails
$credentials = include $_SERVER['DOCUMENT_ROOT'].'iia-timak/configs/database.php';
$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

    
    $name = ; // get name from input field 
    
    
    
    $data = Array(
    'name' => $name
);

$id = $db->insert ('rooms', $data);

if ($id)
    echo 'Vytvorili ste novu miestnost ' . $name ;
else
    echo 'Pri vytvarani nastala chyba ' . $db->getLastError();


?>
