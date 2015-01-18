<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');
$groups = $db->get('exercises');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
    <link rel="stylesheet" href="/style/bootstrap-timepicker.min.css"/>
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h1>Edit  Exercise</h1>
                    <form action="<?php echo $app->urlFor('admin.exercises.update'); ?>" method="POST">
                        
                        <select class='form-control' value="id" name="id">
                        <?php foreach($groups as $group): ?>
                            <option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > 
                            <?php echo "subject"; echo $group['subject_id']; echo ", room "; echo $group['room_id']; 
                            echo ", user ";echo $group['user_id']; echo ", day"; echo $group['day']; ?>


                             </option>
                        <?php endforeach; ?>

                    </select>


                    <!-- <ul> -->         
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
                               <label >Start time</label> 
                               <input id="timepicker1" class='form-control' type="text" name="start_time" />
    
                                </div>
                               <!-- </li> -->
                           <!--  <li> -->
                           <div class="form-group">
                               <label >End time</label> 
                                <input id="timepicker2" class='form-control' type="text" name="end_time" />
                            </div><!-- </li> -->
                            
                           <!--  <li> -->
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

                            <!--  <li> -->
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

                          <!--    </li> -->
                             

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="Add" />
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