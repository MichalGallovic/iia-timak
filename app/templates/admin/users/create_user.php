<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');
$groups = $db->get('groups');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Create user</h1>
	 
	 <form action="<?php echo $app->urlFor('admin.users.store'); ?>" method="POST">
   
	 <ul>         
            <li>Role

                <select name="role_id" />

                <?php foreach($roles as $role): ?>
                    <option value="<?php echo $role['id'] ?>">
                    	<?php echo $role['name']; ?>
                    </option>
                <?php endforeach; ?>
   
                </select>

             </li>


            <li>Google <input type="text" name="google" /></li>
            <li>First name <input type="text" name="firstname" /></li>
            <li>Surname <input type="text" name="surname" /></li>
            <li>Title 1 <input type="text" name="title1" /></li>
            <li>Title 2 <input type="text" name="title2" /></li>
            <li>LDAP <input type="text" name="ldap" /></li>
            
            <li>
                <select name="group_id" />

                <?php foreach($groups as $group): ?>
                    <option value="<?php echo $group['id'] ?>">
                    	<?php echo $group['code']; echo ", "; echo $group['name'];  ?>
                  </option>
                <?php endforeach; ?>

                </select>
            </li>


    </ul>
    
     <input type="submit" value="Add" />
    </form>


</body>
</html>