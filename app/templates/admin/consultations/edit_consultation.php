<?php
use IIA\Auth\Auth as Auth;
use IIA\Lang\Lang as Lang;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$consultations = $db->get('consultations');
$subjects = $db->get('subjects');
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
                    <h1><?php echo Lang::get('consultations_editheader') ?></h1>
                    <form action="<?php echo $app->urlFor('admin.consultations.update'); ?>" method="POST">
                        
                           
                                <select class='form-control' name="id" />

                                <?php foreach($consultations as $consultation): ?>

                                   
                                      
                                 <?php
                                    
                                    $db->join("subjects s", "c.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $consultation['subject_id']);

                                    $subs = $db->get ("consultations c", null, "s.acronym, s.name");
                                  // var_dump($subs[0]);

                                    $sub= $subs[0][ 'name'];
                                    $acro = $subs[0]['acronym'];


                                    $db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
                                    
                            
                                    ?>         

                                    <option value="<?php echo $consultation['id'] ?>"><?php echo $dayNames[$consultation['day']];
                                    echo ", "; echo $consultation['start_time']; echo "-"; echo $consultation['end_time']; 
                                    echo ", "; echo $acro; echo ", "; echo $t1; echo " "; echo $firstname; echo " "; echo $surname;
                                    echo ", "; echo $t2;  ?></option>
                                <?php endforeach; ?>

                                </select>




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