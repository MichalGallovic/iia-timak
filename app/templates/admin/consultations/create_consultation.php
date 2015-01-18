<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Create Consultation</h1> 

    <form action="<?php echo $app->urlFor('admin.consultations.store'); ?>" method="POST">
        
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
        <input type="submit" value="Add" />
    </form>
</body>
</html>