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
                <div class="col-md-5">
                    <h1><?php echo Lang::get('exercises_createheader') ?></h1>
                    <form action="<?php echo $app->urlFor('admin.exercises.store'); ?>" method="POST">

                                <div class="form-group">
                                   <label ><?php echo Lang::get('common_subject') ?></label>

                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                            
                            <div class="form-group">
                               <label ><?php echo Lang::get('common_start') ?></label>
                               <input id="timepicker1" type="text" class="form-control" name="start_time"/>
                             </div>

                            <div class="form-group">
                               <label ><?php echo Lang::get('common_end') ?></label>
                               <input id="timepicker2" type="text" class="form-control" name="end_time"/>
                             </div>
                            

                            <div class="form-group">
                               <label ><?php echo Lang::get('common_teacher') ?></label>
                                <select class='form-control' name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="form-group">
                               <label ><?php echo Lang::get('common_room') ?></label>

                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>

                                
                          </div>

                             <div class="form-group">
                                <label ><?php echo Lang::get('exercises_day') ?></label>

                                <select class='form-control' name="day" />

                                
                                    <option value="0"><?php echo Lang::get('common_days')[0] ?></option>
                                    <option value="1"><?php echo Lang::get('common_days')[1] ?></option>
                                    <option value="2"><?php echo Lang::get('common_days')[2] ?></option>
                                    <option value="3"><?php echo Lang::get('common_days')[3] ?></option>
                                    <option value="4"><?php echo Lang::get('common_days')[4] ?></option>
                                    <option value="5"><?php echo Lang::get('common_days')[5] ?></option>
                                    <option value="6"><?php echo Lang::get('common_days')[6] ?></option>
                               

                                </select>
                            </div>

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