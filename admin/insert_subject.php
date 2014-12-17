<?php
require_once $_SERVER['DOCUMENT_ROOT'].'iia-timak/vendor/Mysql/MysqliDb.php';

// nacitanie db credentails
$credentials = include $_SERVER['DOCUMENT_ROOT'].'iia-timak/configs/database.php';
$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

    
    var_dump($_POST);
    
    
    /*
    $data = Array ("subject_id" => "admin",
               "start_time" => "John",
               "end_time" => 'Doe',
               "user_id" => "John",
               "room_id" => "John"        
    )

    $id = $db->insert('subjects', $data);
    if($id)
        echo 'user was created. Id='.$id;
    */
    
?>