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
            <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Delete Lecture</h1> 

                    <form action="<?php echo $app->urlFor('admin.lectures.remove'); ?>" method="POST">
                        
                                <select class='form-control' name="id" />

                                <?php foreach($lectures as $lecture): ?>
                                    <option value="<?php echo $lecture['id'] ?>"><?php echo "subject id: "; 
                                    echo $lecture['subject_id']; echo ", start time "; echo $lecture['start_time']; 
                                    echo ", end time"; echo $lecture['end_time']; echo ", room ";
                                     echo $lecture['room_id'];  echo ", "; echo $lecture['user_id']; echo ", day";
                                     echo $lecture ['day'];  ?></option>
                                <?php endforeach; ?>

                                </select>

                        <input class='btn btn-primary' type="submit" value="delete" />
                    </form>
                    
                    
                </div>
            </div>
        </div>
    
</body>
</html>