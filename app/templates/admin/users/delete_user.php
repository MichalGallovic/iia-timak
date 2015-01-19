<?php
use IIA\Lang\Lang as Lang;

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
	 <title><?php echo Lang::get('navbar_brand') ?></title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
	<div class="nav navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo Lang::get('navbar_brand') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_logout') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
	<div class="container">
			<div class="row">
				<div class="col-md-4">
						<h1>Edit user</h1>
						 	
						 	<form action="<?php echo $app->urlFor('admin.users.remove'); ?>" method="POST">
					   


						<select class='form-control' value="id" name="id">
							<?php foreach($users as $user): ?>
								<option name="<?php echo $user['id'] ?>" value="<?php echo $user['id'] ?>" > 
									<?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", ";
								 echo $user['surname']; echo " "; echo $user['title2']; ?></option>
							<?php endforeach; ?>

						</select>

						
					    
					     <input class='btn btn-primary' type="submit" value="Delete" />
					    </form>
					
					
				</div>
			</div>
		</div>
	


</body>
</html>

