<?php
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
    <title>Document</title>
</head>
<body>
    <h1>Edit Lecture</h1> 

    <form action="<?php echo $app->urlFor('admin.lectures.update'); ?>" method="POST">
        
                <select name="id" />

                <?php foreach($lectures as $lecture): ?>
                    <option value="<?php echo $lecture['id'] ?>"><?php echo "subject id: "; echo $lecture['subject_id']; echo ", start time "; echo $lecture['start_time']; echo ", end time"; echo $lecture['end_time']; echo ", room "; echo $lecture['room_id'];  echo ", "; echo $lecture['user_id'];  ?></option>
                <?php endforeach; ?>

                </select>


    <ul>         
            <li>Subjects

                <select name="subject_id" />

                <?php foreach($subjects as $subject): ?>
                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                <?php endforeach; ?>

                </select>

             </li>


            <li>Start time <input type="text" name="start_time" /></li>
            <li>End time <input type="text" name="end_time" /></li>
            
            <li>Teacher
                <select name="user_id" />
                

                <?php foreach($users as $user): ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                <?php endforeach; ?>

                </select>
            </li>



            <li>Room

                    <select name="room_id" />

                <?php foreach($rooms as $room): ?>
                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                <?php endforeach; ?>

                </select>

                
          
            </li>

               <li>Day

                <select name="day" />

                
                    <option value="0">Mon</option>
                    <option value="1">Tue</option>
                    <option value="2">Wed</option>
                    <option value="3">Thu</option>
                    <option value="4">Fri</option>
                    <option value="5">Sat</option>
                    <option value="6">Sun</option>
               

                </select>

             </li>

    </ul>
        <input type="submit" value="edit" />
    </form>
</body>
</html>