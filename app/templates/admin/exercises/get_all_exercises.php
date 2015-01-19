<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('exercises');


$dayNames = array(
    
    0=>'Monday', 
    1=>'Tuesday', 
    2=>'Wednesday', 
    3=>'Thursday', 
    4=>'Friday', 
    5=>'Saturday', 
    6=>'Sunday'
 );

$dni = array(
    
    0=>'Pondelok', 
    1=>'Utorok', 
    2=>'Streda', 
    3=>'Štvrtok', 
    4=>'Piatok', 
    5=>'Sobota', 
    6=>'Nedeľa'
 );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo Lang::get('navbar_brand') ?></title>
	<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

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
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_exercises') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.exercises') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.exercises.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_subjects') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.subjects') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.subjects.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_lectures') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.lectures') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.lectures.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_consultations') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.consultations') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.consultations.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_rooms') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.rooms') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.rooms.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_users') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.users') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.users.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_roles') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.roles') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.roles.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('navbar_groups') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.groups') ?>"><?php echo Lang::get('crud_read') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.create') ?>"><?php echo Lang::get('crud_create') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.edit') ?>"><?php echo Lang::get('crud_edit') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.groups.delete') ?>"><?php echo Lang::get('crud_delete') ?></a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $app->urlFor('admin.index') ?>"><i class="glyphicon glyphicon-user"></i> <?php echo Lang::get('navbar_profile') ?></a></li>
                        <li><a href="<?php echo $app->urlFor('admin.settings')?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo Lang::get('navbar_settings')?></a></li>
                        <li><a href="<?php echo $app->urlFor('logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <?php echo Lang::get('navbar_logout')?></a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Exercises</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									subject
								</th>
								<th>
									user
								</th>
								<th>
									room
								</th>
								<th>
									day
								</th>
								<th>
									start time
								</th>
								<th>
									end time
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($groups as $group): ?>

								<?php
									// join na subjects 
									$db->join("subjects s", "e.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $group['subject_id']);

                                    $exers = $db->get ("exercises e", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na exercises
                                    $db->join("users u", "e.user_id=u.id", "LEFT");
                                    $db->where("u.id", $group['user_id']);

                                    $usrs = $db->get ("exercises e", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "e.room_id=r.id", "LEFT");
                                    $db->where("r.id", $group['room_id']);

                                    $rms = $db->get ("exercises e", null, "r.name");

                                    $rname = $rms[0]['name'];
                                   

								?>


								<tr><td><?php  echo $acro; echo ", "; echo $name ?></td>
									<td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
									<td><?php echo $rname; ?></td><td><?php echo $dni[$group['day']]; ?></td>
									<td><?php echo $group['start_time']; ?> </td><td><?php echo $group['end_time']; ?></td></tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
						
					
					
					
				</div>
			</div>
		</div>
	
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
</body>
</html>