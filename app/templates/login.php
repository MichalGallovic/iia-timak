
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1><?php echo $flash['error_message'] ?></h1>
<form action="<?php echo $app->urlFor('auth'); ?>" method="POST">
    <label for="">ldap username</label>
    <input type="text" name="username"/><br/>
    <label for="">ldap password</label>
    <input type="password" name="password"/><br/>
    <button type="submit">Prihlasit</button>
</form>
</body>
</html>