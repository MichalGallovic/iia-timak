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
    <h1>Create Subject</h1> 

    <form action="<?php echo $app->urlFor('admin.subjects.store'); ?>" method="POST">
        
    
    <ul>         
            <li>Code  <input type="text" name="code" /></li>
            <li>Name <input type="text" name="name" /></li>
            <li>Acronym <input type="text" name="acronym" /></li>
            <li>Lecture duration

                    <select name="lecture_duration">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                </li>
            <li>Exercise duration


                    <select name="exercise_duration">
                        
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        
                    </select>
            </li>
            <li>Color TUTO KUBO POROB KOLOR PIKER (PIKENKO) <input type="text" name="color" /></li>
            <li>Term 

                    <select name="term">
                        
                        <option value="W">winter</option>
                        <option value="S">summer</option>
                       
                        
                    </select>


            </li>

    </ul>
        <input type="submit" value="Add" />
    </form>
</body>
</html>