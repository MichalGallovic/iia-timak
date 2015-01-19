<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$rooms = $db->get('rooms');

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
				<div class="col-md-3">
					<h1>Edit Room</h1>
					<p>Select room to edit</p>
					<form action="<?php echo $app->urlFor('admin.rooms.update'); ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($rooms as $room): ?>
							<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
						<?php endforeach; ?>

					</select>

<!-- 					<input class='form-control' type="text" name="newname" />
 -->
					<div class="form-group">
					   <label >New Name:</label>
					   <input type="text" class="form-control" name="newname"/>
					 </div>
					<div>
					<input class="btn btn-primary" type="submit" value="edit" />
					</div>
					</form>
					
					
				</div>
			</div>
		</div>
	

</body>
</html>