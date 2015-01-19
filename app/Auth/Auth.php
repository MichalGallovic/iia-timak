<?php

namespace IIA\Auth;

use IIA\service\repositories\UsersRepository as UsersRepository;
use \Google_Client as Google_Client;
use \Google_Service_Oauth2 as Google_Service_Oauth2;
use IIA\Lang\Lang as Lang;
class Auth {

    protected $app;
    protected $users;

    public function __construct($app) {
        $this->app = $app;
        $this->users = new UsersRepository($app->config('db'));

    }
    public function loginLDAP($username, $password) {
        // defaultne prihlasit cez ldap
        // ak nebude v systeme jeho ldap tak sa neprihlasi
        // ak sa prihlasi cez gmail, ale nebude v db, tak ho neprihlasi
        // lebo gmail si moze az v systeme pripojit
        // az ked bude gmail assigned k userovi potom sa cez neho mozeme aj pripojit

        // validate username
        if(strlen($_POST["username"]) == 0) {
            $this->app->flash('error_message','Zadajte prihlasovacie meno.');
            $this->app->redirect($this->app->urlFor('login'));
        }

        // validate password
        if(strlen($_POST["password"]) == 0) {
            $this->app->flash('error_message','Zadajte heslo.');
            $this->app->flash('username',$_POST['username']);
            $this->app->redirect($this->app->urlFor('login'));
        }

        // test if in db
        $result = $this->users->getByLdap($username);
        $message = "";
        if($result) {
            $username = 'uid='.$_POST["username"].', ou=People, DC=stuba, DC=sk';
            $password = $_POST["password"];
            $ldapconn = ldap_connect("ldap.stuba.sk");

            try {
                // ldap does not work in localhost - so we emulate this behavior
                $localhostNames = ['iia.dev','localhost:8888','192.168.88.88'];
                $allowedPasswords = ['xgallovicm','xhoblikj','xpacko','xfornadelj','zakova'];
                if(!in_array($_SERVER['HTTP_HOST'],$localhostNames)) {
                    $ldapbind = ldap_bind($ldapconn, $username, $password);
                    if($ldapbind) {
                        // everything is fine
                        $_SESSION['user_id'] = $result['id'];
                        $role = $this->users->getUserRoleById($result['id']);
                        return $this->app->redirect($this->app->urlFor($role.'.index'));

                    } else {
                        $message = 'Zadali ste nespravne meno alebo heslo.';
                    }
                } else {
                        if(in_array($password,$allowedPasswords)) {
                            $_SESSION['user_id'] = $result['id'];
                            $role = $this->users->getUserRoleById($result['id']);
                            return $this->app->redirect($this->app->urlFor($role.'.index'));
                        } else {
                            $message = 'Zadali ste nespravne meno alebo heslo.';
                        }
                }

            } catch(\ErrorException $e) {
                $message = 'Server LDAP je momentalne mimo prevadzky.';
            }
        } else {
            $message = 'Zadali ste nespravne meno alebo heslo.';
        }

        $this->app->flash('error_message',$message);
        $this->app->redirect($this->app->urlFor('login'));

    }

    public function loginGoogle() {

        // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
        $application_name = 'IIARozvrhy';
        $client_id = '489912615381-00qk84fqk1gmdfclgtovama4t5jc38vm.apps.googleusercontent.com';
        $client_secret = 'z1ZmJzyQ8kUo4yzoAqYcHXyw';
        $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$this->app->urlFor('auth.google');


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


        //Add Access Token to Session
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
        }

        //Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        //Get User Data from Google Plus
        if ($client->getAccessToken()) {
            $userData = $objOAuthService->userinfo->get();
            if(!empty($userData)) {
                $user = $this->users->getByGoogle($userData['email']);
                if($user) {
                    $user = $user[0];
                    $_SESSION['user_id'] = $user['id'];
                    $role = $this->users->getUserRoleById($user['id']);
                    return $this->app->redirect($this->app->urlFor($role.'.index'));
                } else {
                    $this->app->flash('error_message','Vas gmail ucet nie je pripojeny ku ziadnemu LDAP. Prihlaste sa najskor cez LDAP.');
                    unset($_SESSION['access_token']);
                    $client->revokeToken();
                    return $this->app->redirect($this->app->urlFor('login'));
                }
            }
        } else {
            $this->app->redirectTo($this->app->urlFor('login'),401);
        }

    }

    public function getGoogleLinkUrl() {
        // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
        $application_name = 'IIARozvrhy';
        $client_id = '489912615381-00qk84fqk1gmdfclgtovama4t5jc38vm.apps.googleusercontent.com';
        $client_secret = 'z1ZmJzyQ8kUo4yzoAqYcHXyw';
        $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$this->app->urlFor($this->getUserRole().'.settings');


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

        //generate auth url

        return $client->createAuthUrl();
    }

    public function linkGoogle() {
        // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
        $application_name = 'IIARozvrhy';
        $client_id = '489912615381-00qk84fqk1gmdfclgtovama4t5jc38vm.apps.googleusercontent.com';
        $client_secret = 'z1ZmJzyQ8kUo4yzoAqYcHXyw';
        $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$this->app->urlFor($this->getUserRole().'.settings');


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


        //Add Access Token to Session
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
        }

        //Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        //Get User Data from Google Plus
        if ($client->getAccessToken()) {
            $userData = $objOAuthService->userinfo->get();
            if(!empty($userData)) {
                if(isset($_SESSION['user_id'])) {
                    $user = $this->users->getByGoogle($userData['email']);
                    if(count($user) == 0) {
                        if($this->users->insertGPlus($_SESSION['user_id'],$userData['email'])) {
                            $this->app->flash('message',Lang::get('messages_gplussuccess'));
                        } else {
                            $this->app->flash('message',Lang::get('messages_gplusfail'));
                        }
                    } else {
                        $this->app->flash('message',Lang::get('messages_gplusmultiplefail'));
                    }

                }
            }
        } else {
            $this->app->flash('message',Lang::get('messages_gplusfail'));
        }
        return $this->app->redirect($this->app->urlFor($this->getUserRole().'.settings'));

    }

    public function unlinkGoogle() {
        if(isset($_SESSION['user_id'])) {
            if($this->users->insertGPlus($_SESSION['user_id'],NULL)) {
                $this->app->flash('message',Lang::get('messages_gplusunlinkSuccess'));
            } else {
                $this->app->flash('message',Lang::get('messages_gplusfail'));
            }
        }
        return $this->app->redirect($this->app->urlFor($this->getUserRole().'.settings'));
    }

    public function getUserEmail() {
        $email = "";
        if(isset($_SESSION['user_id'])) {
            $email .= $this->users->getById($_SESSION['user_id'])['google'];
        }
        return $email;
    }

    public function check() {
        if(!isset($_SESSION['user_id'])) {
            return false;
        }
        return true;
    }

    public function getUserRole() {
        if(isset($_SESSION['user_id'])) {
            return $this->users->getUserRoleById($_SESSION['user_id']);
        }
        return 'guest';
    }
    public function getUser() {
        if(isset($_SESSION['user_id'])) {
            return $this->users->getById($_SESSION['user_id']);
        } else {
            return [];
        }
    }

    public function getFullName() {
        $user = $this->getUser();
        $fullname = '';
        if($user) {
            if($user['firstname'] && $user['surname']) {
                $fullname = $user['firstname'] . " " . $user['surname'];
            } else {
                $fullname = $user['ldap'];
            }
        }


        return $fullname;

    }
    public function logout() {
        unset($_SESSION['user_id']);
        if(isset($_SESSION['access_token'])) {
            // Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
            $application_name = 'IIARozvrhy';
            $client_id = '489912615381-00qk84fqk1gmdfclgtovama4t5jc38vm.apps.googleusercontent.com';
            $client_secret = 'z1ZmJzyQ8kUo4yzoAqYcHXyw';
            $redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].$this->app->urlFor('auth.google');

            $client = new Google_Client();
            $client->setApplicationName($application_name);
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect_uri);
            $client->setScopes(array(
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
            ));
            unset($_SESSION['access_token']);

            $client->revokeToken();
        }
        return $this->app->redirect($this->app->urlFor('site.index'));
    }
}