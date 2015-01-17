<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$subjects = $db->get('subjects');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update room</title>
</head>
<body>
	<h1>Edit Subject</h1>
	<p>Select room to edit</p>
	<form action="<?php echo $app->urlFor('admin.subjects.update') ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($subjects as $subject): ?>
			<option name="<?php echo $subject['id'] ?>" value="<?php echo $subject['id'] ?>" > <?php echo $subject['name'] ?> </option>
		<?php endforeach; ?>

	</select>


 	 <ul>         
            <li>Code  <input type="text" name="code" /></li>
            <li>Name <input type="text"  name="newname" /></li>
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


	<input type="submit" value="edit" />
	</form>

</body>
</html>