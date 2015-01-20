<?php
use IIA\Lang\Lang as Lang;

//var_dump($_POST);
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

$input = [];

foreach($_POST as $key => $value) {
    $newkey = str_replace('select_','',$key);
    $input = $input + [$newkey => $value];
}

var_dump($input);

// lectures data
$db->where('id',$input['subject']);
$subject = $db->getOne('subjects');

$newLecture = [
    'subject_id' => $subject['id'],
    'start_time' => $input['time']*100,
    'end_time'   => $input['time']*100*$subject['lecture_duration'],
    'user_id'    => $input['lecturer'],
    'room_id'    => $input['place']
];

var_dump($newLecture);

$db->insert('lectures',$newLecture);



// exercises data