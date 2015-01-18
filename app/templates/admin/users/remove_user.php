<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$id = $_POST['id']	; 

 // var_dump($id);
	
	 $db->where('id', $id);
     $db->delete('users');
    
   
?>