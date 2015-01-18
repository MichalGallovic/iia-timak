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
            <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-md-3">
                        <h1>Create Role</h1>
                        <form action="<?php echo $app->urlFor('admin.roles.store'); ?>" method="POST">
                            
                        
<!--                         <ul>         
 -->                                
                                <input type="hidden" value="off" name="create" />
                                <input type="hidden" value="off" name="read" />
                                <input type="hidden" value="off" name="update" /> 
                                <input type="hidden" value="off" name="delete" />
                                <div class="form-group">
                                   <label >Name</label>
                                   <input type="text" class="form-control" name="name"/>
                                 </div>
                                <div class="form-group">
                                   <label >Can create:</label>
                                   <input type="checkbox"  name="create"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can read:</label>
                                   <input type="checkbox"  name="read"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can update:</label>
                                   <input type="checkbox"  name="update"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can delete:</label>
                                   <input type="checkbox"  name="delete"/>
                                 </div>

                                <!-- <li>Name <input  type="text" name="name" /> </li>
                                <li>Can create: <input type="checkbox" name="create" /> </li>
                                <li>Can read: <input type="checkbox" name="read"> </li>
                                <li>Can update: <input type="checkbox" name="update"> </li>
                                <li>Can delete: <input type="checkbox" name="delete"> </li> -->

<!--                         </ul>
 -->                            <input class="btn btn-primary" type="submit" value="Create Role" />
                        </form> 
                </div>
            </div>
        </div>

   
</body>
</html>