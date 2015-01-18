<?php
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
    <title>Document</title>
            <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1>Edit Consultation</h1> 
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
                               <label >Subjects</label>


                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li> -->

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
                                
                          
                           <!--  </li> -->

                            <!-- <li> -->
                            <div class="form-group">
                               <label >Day</label>
                            

                                <select class='form-control' name="day" />

                                
                                    <option value="0">Mon</option>
                                    <option value="1">Tue</option>
                                    <option value="2">Wed</option>
                                    <option value="3">Thu</option>
                                    <option value="4">Fri</option>
                                    <option value="5">Sat</option>
                                    <option value="6">Sun</option>
                               

                                </select>
                            </div>

                             <!-- </li> -->
                             
<!--                              <li>Note <input type="text" name="note" />
 -->                                <div class="form-group">
                                   <label >Note</label>
                                   <input type="text" class="form-control" name="note"/>
                                 </div>

                            <!-- </li> -->
                             <div class="form-group">
                                   <label >Start time</label>
                                   <input type="text" class="form-control" name="start_time"/>
                                 </div>
                             <div class="form-group">
                                   <label >End time</label>
                                   <input type="text" class="form-control" name="end_time"/>
                                 </div>

                           <!--  <li>Start time <input type="text" name="start_time" /></li>
                            <li>End time <input type="text" name="end_time" /></li> -->

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="Edit" />
                    </form>

                    
                    
                    
                </div>
            </div>
        </div>


</body>
</html>