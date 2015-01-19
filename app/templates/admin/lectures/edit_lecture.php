<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');
$lectures = $db->get('lectures');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title><?php echo Lang::get('navbar_brand') ?></title>
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
    <link rel="stylesheet" href="/style/bootstrap-timepicker.min.css"/>
</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
    <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1>Edit Lecture</h1> 

                    <form action="<?php echo $app->urlFor('admin.lectures.update'); ?>" method="POST">
                        
                                <select class='form-control' name="id" />

                                <?php foreach($lectures as $lecture): ?>


                                <?php

                                    // join na subjects
                                    $db->join("subjects s", "l.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $lecture['subject_id']);

                                    $exers = $db->get ("lectures l", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na users
                                    $db->join("users u", "l.user_id=u.id", "LEFT");
                                    $db->where("u.id", $lecture['user_id']);

                                    $usrs = $db->get ("lectures l", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "l.room_id=r.id", "LEFT");
                                    $db->where("r.id", $lecture['room_id']);

                                    $rms = $db->get ("lectures l", null, "r.name");

                                    $rname = $rms[0]['name'];

                                   ?>

                                    <option value="<?php echo $lecture['id'] ?>">
                                        <?php echo $acro; echo ", "; echo $name; echo ", ";
                                         echo $lecture['start_time']; echo "-"; echo $lecture['end_time'];
                                          echo ", "; echo $rname;  echo ", "; 
                                        echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?>
                                    </option>
                                <?php endforeach; ?>

                                </select>


                    <!-- <ul>   -->       
                            <!-- <li> -->
                            <div class="form-group">
                               <label >Subjects</label>
                            

                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li>
 -->
                            <div class="form-group">
                               <label >Start time</label>
                               <input id="timepicker1" type="text" class="form-control" name="start_time"/>
                             </div>
                            <div class="form-group">
                               <label >End time</label>
                               <input id="timepicker2" type="text" class="form-control" name="end_time"/>
                             </div>
<!--                             <li>Start time <input type="text" name="start_time" /></li>
                            <li>End time <input type="text" name="end_time" /></li>
 -->                            
                            <!-- <li> -->
                            <div class="form-group">
                               <label >Teacher</label>
                                <select class='form-control' name="user_id" />
                                

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label >Room</label>

                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>

                            </div>
                          
                            <!-- </li> -->

                               <!-- <li> -->
                               <div class="form-group">
                                  <label >Day</label>

                                <select class='form-control' name="day" />

                                
                                    <option value="0">Monday</option>
                                    <option value="1">Tuesday</option>
                                    <option value="2">Wednesday</option>
                                    <option value="3">Thursday</option>
                                    <option value="4">Friday</option>
                                    <option value="5">Saturday</option>
                                    <option value="6">Sunday</option>
                               

                                </select>
                            </div>

                             <!-- </li> -->

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="edit" />
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>
    <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/js/libs/bootstrap-timepicker.min.js"></script>
    <script>
        $('#timepicker1').timepicker({
            minuteStep: 1,
            showMeridian: false
        });
        $('#timepicker2').timepicker({
            minuteStep: 1,
            showMeridian: false
        });
    </script>
</body>
</html>