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
                <div class="col-md-4">
                    <h1><?php echo Lang::get('lectures_createheader') ?></h1> 

                    <form action="<?php echo $app->urlFor('admin.lectures.store'); ?>" method="POST">
                        
                   <!--  <ul> -->         
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


                           <!--  <li>Start time <input type="text" name="start_time" /></li>
                            <li>End time <input type="text" name="end_time" /></li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_start') ?></label>
                               <input id="timepicker1" type="text" class="form-control" name="start_time"/>
                             </div>
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_end') ?></label>
                               <input id="timepicker2" type="text" class="form-control" name="end_time"/>
                             </div>
                            
                            <!-- <li> -->
                            
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_teacher') ?></label>
                                <select class='form-control' name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                                </div>
                           <!--  </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_room') ?></label>
                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>

                                </div>
                          
                           <!--  </li> -->

                             <!-- <li> -->
                                <div class="form-group">
                                   <label ><?php echo Lang::get('common_day') ?></label>
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

                   <!--  </ul> -->
                        <input class='btn btn-primary' type="submit" value="<?php echo Lang::get('common_add') ?>" />
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