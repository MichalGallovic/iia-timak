<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$consultations = $db->get('consultations');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Edit Consultation</h1> 

    <form action="<?php echo $app->urlFor('admin.consultations.update'); ?>" method="POST">
        


                <select name="id" />

                <?php foreach($consultations as $consultation): ?>
                    <option value="<?php echo $consultation['id'] ?>"><?php echo "day: "; echo $consultation['day'];
                    echo ", note "; echo $consultation['note']; echo ", start - end "; echo $consultation['start_time'];
                    echo "-"; echo $consultation['end_time']; ?></option>
                <?php endforeach; ?>

                </select>




    <ul>         
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
             
             <li>Note <input type="text" name="note" />

            </li>

            <li>Start time <input type="text" name="start_time" /></li>
            <li>End time <input type="text" name="end_time" /></li>

    </ul>
        <input type="submit" value="Edit" />
    </form>
</body>
</html>