<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('groups');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<title>Update group</title>
</head>
<body>
	<h1>Edit Group</h1>
	<p>Select room to edit</p>
	<form action="<?php echo $app->urlFor('admin.groups.update'); ?>" method="POST">
	<select value="id" name="id">
		<?php foreach($groups as $group): ?>
			<option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > <?php echo $group['name'] ?> </option>
		<?php endforeach; ?>

	</select>

        <ul>
            <li>Group name: <input type="text" name="name" /></li>
             <li>Group code: <input type="text" name="code" /></li>
        </ul>


	<input type="submit" value="edit" />
	</form>

</body>
</html>