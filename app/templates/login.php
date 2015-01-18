<?php

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
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <script src="/js/libs/jquery.min.js"></script>
</head>
<body>
<div class="nav navbar navbar-default">
    <div class="navbar-header"><span class="navbar-brand">FEI Timetable Master Overlord 10 001</span></div>
</div>
<div class="container">
    <h1><?php echo $flash['error_message'] ?></h1>
    <form action="<?php echo $app->urlFor('auth'); ?>" method="POST">
        <label for="">ldap username</label>
        <input value="<?php echo $flash['username'] ?>" type="text" name="username"/><br/>
        <label for="">ldap password</label>
        <input type="password" name="password"/><br/>
        <button type="submit">Prihlasit</button>
    </form>
    <a href="<?php echo $authUrl;?>">Login with Google</a>
</div>
</body>
</html>
