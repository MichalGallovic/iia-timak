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
$groups = $db->get('exercises');


$dayNames = array(
    
    0=>'Monday', 
    1=>'Tuesday', 
    2=>'Wednesday', 
    3=>'Thursday', 
    4=>'Friday', 
    5=>'Saturday', 
    6=>'Sunday'
 );

$dni = array(
    
    0=>'Pondelok', 
    1=>'Utorok', 
    2=>'Streda', 
    3=>'Štvrtok', 
    4=>'Piatok', 
    5=>'Sobota', 
    6=>'Nedeľa'
 );
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
                    <h1><?php echo Lang::get('exercises_editheader') ?></h1>
                    <form action="<?php echo $app->urlFor('admin.exercises.update'); ?>" method="POST">
                        
                        <select class='form-control' value="id" name="id">
                        <?php foreach($groups as $group): ?>


                              <?php
                                    // join na subjects 
                                    $db->join("subjects s", "e.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $group['subject_id']);

                                    $exers = $db->get ("exercises e", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na exercises
                                    $db->join("users u", "e.user_id=u.id", "LEFT");
                                    $db->where("u.id", $group['user_id']);

                                    $usrs = $db->get ("exercises e", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "e.room_id=r.id", "LEFT");
                                    $db->where("r.id", $group['room_id']);

                                    $rms = $db->get ("exercises e", null, "r.name");

                                    $rname = $rms[0]['name'];

                                    ?>


                            <option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > 
                            <?php echo $acro; echo ", "; echo $name; echo ", "; echo $rname; 
                            echo ", ";echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " ";
                            echo $t2; echo ", "; echo $dni[$group['day']]; echo " "; echo $group['start_time']; ?>


                             </option>
                        <?php endforeach; ?>

                    </select>


                    <!-- <ul> -->         
                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_subject') ?></label>

                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>

                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li> -->


                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_start') ?></label> 
                               <input id="timepicker1" class='form-control' type="text" name="start_time" />
    
                                </div>
                               <!-- </li> -->
                           <!--  <li> -->
                           <div class="form-group">
                               <label ><?php echo Lang::get('common_end') ?></label> 
                                <input id="timepicker2" class='form-control' type="text" name="end_time" />
                            </div><!-- </li> -->
                            
                           <!--  <li> -->
                           <div class="form-group">
                              <label ><?php echo Lang::get('common_teacher') ?></label> 
                                <select class='form-control' name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_room') ?></label>
                             

                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                                
                          
                            <!-- </li> -->

                            <!--  <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_day') ?></label>

                                <select class='form-control' name="day" />

                                
                                    <option value="0">Pondelok</option>
                                    <option value="1">Utorok</option>
                                    <option value="2">Streda</option>
                                    <option value="3">Štvrtok</option>
                                    <option value="4">Piatok</option>
                                    <option value="5">Sobota</option>
                                    <option value="6">Nedeľa</option>
                               

                                </select>
                            </div>

                          <!--    </li> -->
                             

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="<?php echo Lang::get('common_edit') ?>" />
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