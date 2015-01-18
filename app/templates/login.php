<?php
use IIA\Lang\Lang as Lang;

// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
$application_name = 'IIARozvrhy';
$client_id = '489912615381-00qk84fqk1gmdfclgtovama4t5jc38vm.apps.googleusercontent.com';
$client_secret = 'z1ZmJzyQ8kUo4yzoAqYcHXyw';
$redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$app->urlFor('auth.google');


//Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName($application_name);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes(array(
    'https://www.googleapis.com/auth/userinfo.email',
    'https://www.googleapis.com/auth/userinfo.profile',
));
//Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);

//Logout
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
    $client->revokeToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
}

//Authenticate code from Google OAuth Flow
//Add Access Token to Session
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

//Set Access Token to make Request
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
}

//Get User Data from Google Plus
if ($client->getAccessToken()) {
    $userData = $objOAuthService->userinfo->get();
    if(!empty($userData)) {

        $_SESSION["username"] = $userData["email"];
        $_SESSION["fullname"] = $userData["name"];

    }
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    $authUrl = $client->createAuthUrl();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/admin.css"/>
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
            <a class="navbar-brand" href="<?php echo $app->urlFor('site.index')?>">FEI Timetable</a>
        </div>
    </div><!-- /.container -->
</div>
<div class="container margin-20">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <?php if($flash['error_message']): ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo $flash['error_message'] ?>
                </div>
            <?php endif; ?>
            <div class="well">
                <h4>Log in</h4>
                <form class="form-horizontal" role="form" method="post" action="<?php echo $app->urlFor('auth'); ?>">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">LDAP username</label>
                        <div class="col-sm-8">
                            <input name="username" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">LDAP password</label>
                        <div class="col-sm-8">
                            <input name="password" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success pull-right">Login</button>
                        </div>
                    </div>
                </form>
                <hr/>
                <div class="row text-center">
                    <a class="text-muted" href="<?php echo $authUrl;?>">Login with Google</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
