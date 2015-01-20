<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


$u_id = $_SESSION['user_id'];

$db->where ('id', $id );
$consultations = $db->get('consultations');

$subjects = $db->get('subjects');

$db->where ('id', $u_id);
$users = $db->get('users');
$rooms = $db->get('rooms');


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
    <title><?php echo Lang::get('navbar_brand') ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
<body>


<!--HEADER-->
<?php $app->render('teacher/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->

<div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo Lang::get('consultations_header') ?></h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo Lang::get('consultations_day') ?></th>
                                <th><?php echo Lang::get('consultations_note') ?></th>
                                <th><?php echo Lang::get('consultations_teacher') ?></th>
                                <th><?php echo Lang::get('consultations_start') ?></th>
                                <th><?php echo Lang::get('consultations_end') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($consultations as $consultation): ?>

                            <?php
                            
                                $db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
                            ?>

                                <tr class='clickableRow' href="<?php echo $app->urlFor('teacher.consultations').'/'. $consultation['id']; ?>"><td><?php echo $dni[$consultation['day']];?></td><td><?php echo $consultation['note'];?></td>
                                    <td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
                                    <td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td></tr>
       
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                  



                     <form action="<?php echo $app->urlFor('teacher.consultations').'/'; echo $id  ?>" method="POST">
                        
                           <input type="hidden" value='<?php echo $id ?>' name="hidden_id" />


                    <!-- <ul>  -->      



                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('consultations_subject') ?></label>


                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li> -->

                              <!-- <li> -->
                              <div class="form-group">
                                 <label ><?php echo Lang::get('consultations_teacher') ?></label>

                                <select class='form-control' name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label ><?php echo Lang::get('consultations_room') ?></label>
                             

                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                                
                          
                           <!--  </li> -->

                            <!-- <li> -->
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

                             <!-- </li> -->
                             
<!--                              <li>Note <input type="text" name="note" />
 -->                                <div class="form-group">
                                   <label ><?php echo Lang::get('consultations_note') ?></label>
                                   <input type="text" class="form-control" name="note"/>
                                 </div>

                            <!-- </li> -->
                             <div class="form-group">
                                   <label ><?php echo Lang::get('consultations_start') ?></label>
                                   <input id="timepicker1" type="text" class="form-control" name="start_time"/>
                                 </div>
                             <div class="form-group">
                                   <label ><?php echo Lang::get('consultations_end') ?></label>
                                   <input id="timepicker2" type="text" class="form-control" name="end_time"/>
                                 </div>

                           <!--  <li>Start time <input type="text" name="start_time" /></li>
                            <li>End time <input type="text" name="end_time" /></li> -->

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="<?php echo Lang::get('consultations_edit') ?>" />
                    </form>

                    
                    
                    
                </div>
            </div>


            <?php 
                // var_dump($consultations[0]);

            // echo $app->urlFor('teacher.consultations').'/edit/'.$id ?>
            <!-- <?php //echo $app->urlFor('teacher.consultations').'/1' ?> -->
        </div>


<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>
<script>
jQuery(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
});
 </script>
</body>
</html>