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
    <h1>Create Group</h1>

    <form  action="<?php echo $app->urlFor('admin.groups.store') ?>" method="POST">
        <ul>
            <li>Group name: <input type="text" name="name" /></li>
             <li>Group code: <input type="text" name="code" /></li>
        </ul>
        
        <input type="submit" value="add" />
    </form>
</body>
</html>