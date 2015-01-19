<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo Lang::get('navbar_brand') ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href='/style/admin.css'>

    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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
                <?php if($auth->check()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $app->urlFor('admin.index') ?>"><i class="glyphicon glyphicon-user"></i> <?php echo Lang::get('navbar_profile') ?></a></li>
                            <li><a href="<?php echo $app->urlFor('admin.settings')?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo Lang::get('navbar_settings')?></a></li>
                            <li><a href="<?php echo $app->urlFor('logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <?php echo Lang::get('navbar_logout')?></a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo $app->urlFor('login') ?>"><i class="glyphicon glyphicon-log-in"></i> <?php echo Lang::get('navbar_login') ?></a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
<div class="container">

    <div class="row margin-20">
        <div class="col-md-4">
            <h3>Zobraz rozvrh pre:</h3>
            <select id="select_type" class="form-control">
                <option value="skovaj">typ</option>
                <option value="predmet">predmet</option>
                <option value="ucitel">učiteľ</option>
                <option value="skupina_ucitelov">skupina učiteľov</option>
                <option value="miestnost">miestnosť</option>
                <option value="den">deň</option>
                <option value="oddelenie">oddelenie</option>
            </select>
        </div>
        <div class="col-md-4">
            <div id="druhy_select" hidden>
                <h3>Druhy Select:</h3>
                <select id="select_detail" class="form-control"></select>
            </div>
            <div id="druhy_select_ucitelia" hidden>
                <h3>Druhy Select: kone</h3>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-12" id='bc' hidden>
            <button id="getSch" class='btn btn-primary'>Zobraz</button>
        </div>    
    </div>
    <div class='row'>
          <div class="col-md-12">
            <div id='tabulka-wrapper'>
              <table  class='table'>
                <colgroup>
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">
                       <col span="1" style="width: 6.66%;">

                    </colgroup>
                  <thead>
                      <tr>
                          <th>Deň</th>
                          <th>6:00</th>
                          <th>7:00</th>
                          <th>8:00</th>
                          <th>9:00</th>
                          <th>10:00</th>
                          <th>11:00</th>
                          <th>12:00</th>
                          <th>13:00</th>
                          <th>14:00</th>
                          <th>15:00</th>
                          <th>16:00</th>
                          <th>17:00</th>
                          <th>18:00</th>
                          <th>19:00</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td class='den' >Pondelok</td>
                          <td id='p-6' class='np'></td>
                          <td id='p-7' class='np'></td>
                          <td id='p-8' class='np'></td>
                          <td id='p-9' class='np'></td>
                          <td id='p-10' class='np'></td>
                          <td id='p-11' class='np'></td>
                          <td id='p-12' class='np'></td>
                          <td id='p-13' class='np'></td>
                          <td id='p-14' class='np'></td>
                          <td id='p-15' class='np'></td>
                          <td id='p-16' class='np'></td>
                          <td id='p-17' class='np'></td>
                          <td id='p-18' class='np'></td>
                          <td id='p-19' class='np'></td>
                      </tr>
                      <tr>
                          <td class='den' >Utorok</td>
                          <td class='np' id='u-6'></td>
                          <td class='np' id='u-7'></td>
                          <td class='np' id='u-8'></td>
                          <td class='np' id='u-9'></td>
                          <td class='np' id='u-10'></td>
                          <td class='np' id='u-11'></td>
                          <td class='np' id='u-12'></td>
                          <td class='np' id='u-13'></td>
                          <td class='np' id='u-14'></td>
                          <td class='np' id='u-15'></td>
                          <td class='np' id='u-16'></td>
                          <td class='np' id='u-17'></td>
                          <td class='np' id='u-18'></td>
                          <td class='np' id='u-19'></td>
                      </tr>
                      <tr>
                          <td class='den' >Streda</td>
                          <td class='np' id='s-6'></td>
                          <td class='np' id='s-7'></td>
                          <td class='np' id='s-8'></td>
                          <td class='np' id='s-9'></td>
                          <td class='np' id='s-10'></td>
                          <td class='np' id='s-11'></td>
                          <td class='np' id='s-12'></td>
                          <td class='np' id='s-13'></td>
                          <td class='np' id='s-14'></td>
                          <td class='np' id='s-15'></td>
                          <td class='np' id='s-16'></td>
                          <td class='np' id='s-17'></td>
                          <td class='np' id='s-18'></td>
                          <td class='np' id='s-19'></td>
                      </tr>
                      <tr>
                          <td class='den' >Štvrtok</td>
                          <td class='np' id='st-6'></td>
                          <td class='np' id='st-7'></td>
                          <td class='np' id='st-8'></td>
                          <td class='np' id='st-9'></td>
                          <td class='np' id='st-10'></td>
                          <td class='np' id='st-11'></td>
                          <td class='np' id='st-12'></td>
                          <td class='np' id='st-13'></td>
                          <td class='np' id='st-14'></td>
                          <td class='np' id='st-15'></td>
                          <td class='np' id='st-16'></td>
                          <td class='np' id='st-17'></td>
                          <td class='np' id='st-18'></td>
                          <td class='np' id='st-19'></td>
                      </tr>
                      <tr>
                          <td class='den' >Piatok</td>
                          <td class='np' id='pi-6'></td>
                          <td class='np' id='pi-7'></td>
                          <td class='np' id='pi-8'></td>
                          <td class='np' id='pi-9'></td>
                          <td class='np' id='pi-10'></td>
                          <td class='np' id='pi-11'></td>
                          <td class='np' id='pi-12'></td>
                          <td class='np' id='pi-13'></td>
                          <td class='np' id='pi-14'></td>
                          <td class='np' id='pi-15'></td>
                          <td class='np' id='pi-16'></td>
                          <td class='np' id='pi-17'></td>
                          <td class='np' id='pi-18'></td>
                          <td class='np' id='pi-19'></td>
                      </tr>

                  </tbody>
              </table>
              </div>
<!--               <a id='tlaciaren' >tlaciaren</a>
 -->            <form id='tlaciaren' action="<?php echo $app->urlFor('genPdf') ?>" method='post'>
              <input id="kone"  type="text" name="print_url"  hidden>
              <button class='btn btn-primary' type='submit'>tlaciaren</button>
            </form>
          </div>
      </div>
</div>
<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>

</body>
</html>