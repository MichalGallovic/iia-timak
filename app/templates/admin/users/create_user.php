<?php
use IIA\Lang\Lang as Lang;

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
                <div class="col-md-5">
                        <h1>Create user</h1>
                         
                         <form action="<?php echo $app->urlFor('admin.users.store'); ?>" method="POST">
                       
                         <!-- <ul>  -->        
                               <!--  <li> -->

                               <div class="form-group">
                                  <label >Role</label>

                                    <select class='form-control' name="role_id" />

                                    <?php foreach($roles as $role): ?>
                                        <option value="<?php echo $role['id'] ?>">
                                            <?php echo $role['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                       
                                    </select>
                                </div>

                                <!--  </li> -->


                                <!-- <li>Google <input type="text" name="google" /></li>
                                <li>First name <input type="text" name="firstname" /></li>
                                <li>Surname <input type="text" name="surname" /></li>
                                <li>Title 1 <input type="text" name="title1" /></li>
                                <li>Title 2 <input type="text" name="title2" /></li>
                                <li>LDAP <input type="text" name="ldap" /></li> -->

                                <div class="form-group">
                                   <label >Google</label>
                                   <input type="text" class="form-control" name="google"/>
                                 </div>
                                 <div class="form-group">
                                    <label >First name</label>
                                    <input type="text" class="form-control" name="firstname"/>
                                  </div>
                                  <div class="form-group">
                                     <label >Surname</label>
                                     <input type="text" class="form-control" name="surname"/>
                                   </div>
                                   <div class="form-group">
                                      <label >Title 1</label>
                                      <input type="text" class="form-control" name="title1"/>
                                    </div>

                                    <div class="form-group">
                                       <label >Title 2</label>
                                       <input type="text" class="form-control" name="title2"/>
                                     </div>
                                     <div class="form-group">
                                        <label >LDAP</label>
                                        <input type="text" class="form-control" name="ldap"/>
                                      </div>
                                
                                <!-- <li> -->
                                    <select class='form-control' name="group_id" />

                                    <?php foreach($groups as $group): ?>
                                        <option value="<?php echo $group['id'] ?>">
                                            <?php echo $group['code']; echo ", "; echo $group['name'];  ?>
                                      </option>
                                    <?php endforeach; ?>

                                    </select>
                                <!-- </li> -->


                        </ul>
                        
                         <input class='btn btn-primary' type="submit" value="Add" />
                        </form>
                    
                    
                    
                </div>
            </div>
        </div>
	


</body>
</html>