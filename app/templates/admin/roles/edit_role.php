<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Role</title>
</head>
<body>
	<h1>Edit Role</h1>
	<p>Select Role to edit</p>
	<form action="<?php echo $app->urlFor('admin.roles.update') ?>" method="POST">
	<select value="id" name="id">

		<?php foreach($roles as $role): ?>
			<option name="<?php echo $role['id'] ?>" value="<?php echo $role['id'] ?>" > <?php echo $role['name'] ?> </option>
		<?php endforeach; ?>

	</select>


 	 <ul>         
          
            <input type="hidden" value="off" name="create" />
            <input type="hidden" value="off" name="read" />
            <input type="hidden" value="off" name="update" /> 
            <input type="hidden" value="off" name="delete" />


            <li>Name <input type="text" name="name" /> </li>
            <li>Can create: <input type="checkbox" name="create" /> </li>
            <li>Can read: <input type="checkbox" name="read"> </li>
            <li>Can update: <input type="checkbox" name="update"> </li>
            <li>Can delete: <input type="checkbox" name="delete"> </li>

    </ul>


	<input type="submit" value="Edit" />
	</form>

</body>
</html>