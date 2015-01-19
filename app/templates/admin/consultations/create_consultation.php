<?php
use IIA\Lang\Lang as Lang;
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
</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
    <div class="container">
            <div class="row">
                <div class="col-md-5">
                    
                    <h1><?php echo Lang::get('consultations_createheader') ?></h1>

                    <form action="<?php echo $app->urlFor('admin.consultations.store'); ?>" method="POST">
                        
                    <ul>         
                        <div class="form-group">
                           <label ><?php echo Lang::get('consultations_subject') ?></label>
                           <select class="form-control" name="subject_id" />

                           <?php foreach($subjects as $subject): ?>
                               <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                           <?php endforeach; ?>

                           </select>
                         </div>



                <div class="form-group">
                   <label ><?php echo Lang::get('consultations_teacher') ?></label>
                   <select class="form-control" name="user_id" />

                 <?php foreach($users as $user): ?>
                     <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                 <?php endforeach; ?>

                   </select>
                 </div>
                              <!-- <li>Teacher
                                <select name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </li> -->



<!--                             <li>Room
 -->
                        <div class="form-group">
                           <label ><?php echo Lang::get('consultations_room') ?></label>
                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>
                             </div>




<!--                             </li>
 -->
                            <!-- <li>Day -->

                                <div class="form-group">
                                   <label ><?php echo Lang::get('consultations_day') ?></label>
                                <select class='form-control' name="day" />

                                
                                    <option value="0"><?php echo Lang::get('consultations_days')[0] ?></option>
                                    <option value="1"><?php echo Lang::get('consultations_days')[1] ?></option>
                                    <option value="2"><?php echo Lang::get('consultations_days')[2] ?></option>
                                    <option value="3"><?php echo Lang::get('consultations_days')[3] ?></option>
                                    <option value="4"><?php echo Lang::get('consultations_days')[4] ?></option>
                                    <option value="5"><?php echo Lang::get('consultations_days')[5] ?></option>
                                    <option value="6"><?php echo Lang::get('consultations_days')[6] ?></option>
                               

                                </select>





                                </div>

<!--                              </li>
 -->
                                <div class="form-group">
                                   <label ><?php echo Lang::get('consultations_note') ?></label>
                                   <input type="text" class="form-control" name="note"/>
                                 </div>
<!--                              <li>Note <input type="text" name="note" />
 -->
<!--                             </li>

 -->

                            <div class="form-group">
                               <label ><?php echo Lang::get('consultations_start') ?></label>
                                <select name="start_time" class="form-control">
                                    <option value="0600">06:00</option>
                                    <option value="0700">07:00</option>
                                    <option value="0800">08:00</option>
                                    <option value="0900">09:00</option>
                                    <option value="1000">10:00</option>
                                    <option value="1100">11:00</option>
                                    <option value="1200">12:00</option>
                                    <option value="1300">13:00</option>
                                    <option value="1400">14:00</option>
                                    <option value="1500">15:00</option>
                                    <option value="1600">16:00</option>
                                    <option value="1700">17:00</option>
                                    <option value="1800">18:00</option>
                                    <option value="1900">19:00</option>
                                    <option value="2000">20:00</option>
                                </select>
                             </div>
                             <div class="form-group">
                                <label ><?php echo Lang::get('consultations_end') ?></label>
                                 <select name="end_time" class="form-control">
                                     <option value="0600">06:00</option>
                                     <option value="0700">07:00</option>
                                     <option value="0800">08:00</option>
                                     <option value="0900">09:00</option>
                                     <option value="1000">10:00</option>
                                     <option value="1100">11:00</option>
                                     <option value="1200">12:00</option>
                                     <option value="1300">13:00</option>
                                     <option value="1400">14:00</option>
                                     <option value="1500">15:00</option>
                                     <option value="1600">16:00</option>
                                     <option value="1700">17:00</option>
                                     <option value="1800">18:00</option>
                                     <option value="1900">19:00</option>
                                     <option value="2000">20:00</option>
                                 </select>
                              </div>
<!--                             <li>Start time <input type="text" name="start_time" /></li>
                          <li>End time <input type="text" name="end_time" /></li>
 -->
<!--                     </ul>
 -->                        <input class='btn btn-primary' type="submit" value="<?php echo Lang::get('consultations_add') ?>" />
                    </form>
                    
                </div>
            </div>
        </div>
    <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>