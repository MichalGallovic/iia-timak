<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');
$groups = $db->get('groups');
$users = $db->get('users');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Edit user</h1>
	 	
	 	<form action="<?php echo $app->urlFor('admin.users.remove'); ?>" method="POST">
   


	<select value="id" name="id">
		<?php foreach($users as $user): ?>
			<option name="<?php echo $user['id'] ?>" value="<?php echo $user['id'] ?>" > 
				<?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", ";
			 echo $user['surname']; echo " "; echo $user['title2']; ?></option>
		<?php endforeach; ?>

	</select>

	
    </ul>
    
     <input type="submit" value="Delete" />
    </form>


</body>
</html>

