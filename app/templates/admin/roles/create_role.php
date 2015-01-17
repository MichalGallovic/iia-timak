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
    <h1>Create Role</h1> 

    <form action="<?php echo $app->urlFor('admin.roles.store'); ?>" method="POST">
        
    
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
        <input type="submit" value="Create Role" />
    </form>
</body>
</html>