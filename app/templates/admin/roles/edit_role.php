<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');

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
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h1><?php echo Lang::get('roles_editheader') ?></h1>
					<label><?php echo Lang::get('common_role') ?></label>
					<form action="<?php echo $app->urlFor('admin.roles.update') ?>" method="POST">
					<select class="form-control" value="id" name="id">
					<?php foreach($roles as $role): ?>
						<option name="<?php echo $role['id'] ?>" value="<?php echo $role['id'] ?>" > <?php echo $role['name'] ?> </option>
					<?php endforeach; ?>
					</select>


				 	 <!-- <ul>          -->
				          
				            <input type="hidden" value="off" name="create" />
				            <input type="hidden" value="off" name="read" />
				            <input type="hidden" value="off" name="update" /> 
				            <input type="hidden" value="off" name="delete" />


				           <!--  <li>Name <input type="text" name="name" /> </li>
				            <li>Can create: <input type="checkbox" name="create" /> </li>
				            <li>Can read: <input type="checkbox" name="read"> </li>
				            <li>Can update: <input type="checkbox" name="update"> </li>
				            <li>Can delete: <input type="checkbox" name="delete"> </li> -->
                                <div class="form-group">

				               <label ><?php echo Lang::get('common_name') ?></label>
				               <input type="text" class="form-control" name="name"/>
				             </div>
				            <div class="form-group">
				               <label ><?php echo Lang::get('roles_cancreate') ?></label>
				               <input type="checkbox"  name="create"/>
				             </div>
				             <div class="form-group">
				               <label ><?php echo Lang::get('roles_canread') ?></label>
				               <input type="checkbox"  name="read"/>
				             </div>
				             <div class="form-group">
				               <label ><?php echo Lang::get('roles_canupdate') ?></label>
				               <input type="checkbox"  name="update"/>
				             </div>
				             <div class="form-group">
				               <label ><?php echo Lang::get('roles_candelete') ?></label>
				               <input type="checkbox"  name="delete"/>
				             </div>

				    <!-- </ul> -->


					<input class="btn btn-primary" type="submit" value="<?php echo Lang::get('common_edit') ?>" />
					</form>
					
					
					
				</div>
			</div>
		</div>
	

	 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	

	

</body>
</html>