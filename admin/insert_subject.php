<?php
require '../vendor/autoload.php';
$credentials = getDbCredentias();

$db = new MysqliDb ($credentials['host'], $credentials['username'],
    $credentials['password'], $credentials['dbName']);

    
    var_dump($_GET);
    
    //var_dump($_GET['select_term']);
    
    // ----------------- get info from form -------------
    
    //vseobecne pre predmet
    $term = $_GET['select_term'];       // id termu
    $subject = $_GET['select_subject']; // id subjectu
    $count = $_GET['select_exc_count'];
    
    //pre prednasku
    $lecturer = $_GET['select_lecturer'];   // id lecturer
    $day = $_GET['select_day'];             // id
    $time = $_GET['select_time'];         //start time
    $place = $_GET['select_place'];         // id place
    
    
    // get duration of lecture
    $db->where ("id", $subject);
    $tmp = $db->getOne ("subjects");
    $duration = $tmp['lecture_duration'];
    
    //magic end time ?
    $end_time = '666' ;
    
    // -------------------- insert lecture -----------------
    
    //insert lecture
    
    $data = Array ("subject_id" => $subject,
               "start_time" => $time,
               "end_time" => $end_time,          // TODO doratat
               "user_id" => $lecturer,
               "room_id" => $place,
    );
    
    // ked je vsetko vporadku mozem spustit tento insert
    
 //   $id = $db->insert('lectures', $data);
 //   if($id)
  //      echo 'lecture was created. Id='.$id;
    
    
    //---------------------- get info for EACH exercise ----------
    
    // LET THE FOR BEGIN
    // cviko veci
    
    if ($count > 0) {
        
        // sem pojde for podla countu
        // naplnat 
    
        $instructor = $_GET['select_instructor_cv_0'];
        $day_cv = $_GET['select_exc_day_cv_0'];
        $time_cv = $_GET['select_exc_time_cv_0'];
        $place_cv = $_GET['select_exc_place_cv_0'];
    
  
    
    
    
    
/*
    $id = $db->insert('subjects', $data);
    if($id)
        echo 'user was created. Id='.$id;
    */

    }
    
?>