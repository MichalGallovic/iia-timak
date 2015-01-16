<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


 $id = $_POST['id'];
 $name =  $_POST ['newname'];

 $data = Array(
    'name' => $name
);

// var_dump($id);
// var_dump($data);

$db->where ('id', $id);

$db->update ('rooms', $data);
//     echo $db->count . ' miestnosti bolo zmenenych';
// else
//     echo 'update failed: ' . $db->getLastError();

?>