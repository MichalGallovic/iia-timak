<?php
use IIA\Lang\Lang as Lang;

//var_dump($_POST);
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

$input = [];
$error = 0;
$message = '';
foreach($_POST as $key => $value) {
    $newkey = str_replace('select_','',$key);
    $newkey = str_replace('exc_','',$newkey);
    $input = $input + [$newkey => $value];
}



//var_dump($input);

// lectures data
$db->where('id',$input['subject']);
$subject = $db->getOne('subjects');

$newLecture = [
    'subject_id' => $subject['id'],
    'start_time' => $input['time']*100,
    'end_time'   => ($input['time']+100*$subject['lecture_duration'])*100,
    'user_id'    => $input['lecturer'],
    'room_id'    => $input['place'],
    'day'        => $input['day']
];

//var_dump($newLecture);

$lectureID = $db->insert('lectures',$newLecture);

if($lectureID) {
    // exercise data

    $newExercises = [];

    foreach($input as $key => $value) {
        $parsed = explode('_',$key);
        $index = $parsed[count($parsed)-1];
        if(is_numeric($index)) {
            if(array_key_exists($index, $newExercises)) {
                $newExercises[$index] += [$parsed[0] => $value];
            } else {
                array_push($newExercises,[$parsed[0] => $value]);
            }
        }
    }

// add to db
    $dayConvertor = ['pondelok'=>0,'utorok'=>1,'streda'=>2,'stvrtok'=>3,'piatok'=>4];
    foreach($newExercises as $index => $oneExercise) {
        $newExercise = [
            'start_time' => $oneExercise['time']*100,
            'end_time'   => ($oneExercise['time']+100*$subject['exercise_duration'])*100,
            'user_id'    => $oneExercise['instructor'],
            'room_id'    => $oneExercise['place'],
            'day'        => $dayConvertor[$oneExercise['day']],
            'subject_id' => $subject['id']
        ];

        $exerciseID = $db->insert('exercises',$newExercise);

        if(!$exerciseID) {
            $error = 1;
            break;
        }
    }

    if(!$error) {
        $message = Lang::get('schedules_success');
    } else {
        $message = Lang::get('schedules_fail');
    }
} else {
    $message = Lang::get('schedules_fail');
}

$app->flash('message',$message);
$app->redirect($app->urlFor('admin.schedules.create'));

