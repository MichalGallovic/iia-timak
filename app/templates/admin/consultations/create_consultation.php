<?php
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
    <title>Document</title>
            <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-5">
                    
                    <h1>Create Consultation</h1> 

                    <form action="<?php echo $app->urlFor('admin.consultations.store'); ?>" method="POST">
                        
                    <ul>         
                        <div class="form-group">
                           <label >Subject</label>
                           <select class="form-control" name="subject_id" />

                           <?php foreach($subjects as $subject): ?>
                               <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                           <?php endforeach; ?>

                           </select>
                         </div>
<!--                             <li>Subjects
 -->
                               

<!--                              </li>
 -->


                <div class="form-group">
                   <label >Teacher</label>
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
                           <label >Room</label>
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

<!--                              </li>
 -->                             
                                <div class="form-group">
                                   <label >Note</label>
                                   <input type="text" class="form-control" name="note"/>
                                 </div>
<!--                              <li>Note <input type="text" name="note" />
 -->
<!--                             </li>

 -->

                            <div class="form-group">
                               <label >Start time</label>
                               <input type="text" class="form-control" name="start_time"/>
                             </div>
                             <div class="form-group">
                                <label >End time</label>
                                <input type="text" class="form-control" name="end_time"/>
                              </div>
<!--                             <li>Start time <input type="text" name="start_time" /></li>
                          <li>End time <input type="text" name="end_time" /></li>
 -->  
<!--                     </ul>
 -->                        <input class='btn btn-primary' type="submit" value="Add" />
                    </form>
                    
                </div>
            </div>
        </div>
    
</body>
</html>