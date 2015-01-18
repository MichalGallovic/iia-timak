<?php

namespace IIA\Auth;

use IIA\service\repositories\UsersRepository as UsersRepository;

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
    public function logout() {
        unset($_SESSION['user_id']);
        return $this->app->redirect($this->app->urlFor('site.index'));
    }
}