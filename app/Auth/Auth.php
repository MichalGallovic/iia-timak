<?php

namespace IIA\Auth;

class Auth {

    protected $db;
    protected $app;

    public function __construct($app) {
        $this->app = $app;
        $credentials = $app->config('db');
        $this->db = new \MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
    }
    public function loginLDAP($username, $password) {
        // defaultne prihlasit cez ldap
        // ak nebude v systeme jeho ldap tak sa neprihlasi
        // ak sa prihlasi cez gmail, ale nebude v db, tak ho neprihlasi
        // lebo gmail si moze az v systeme pripojit
        // az ked bude gmail assigned k userovi potom sa cez neho mozeme aj pripojit

        // test if in db
        $this->db->where('ldap',$username);
        $result = $this->db->get('users');

        if($result) {
            $username = 'uid='.$_POST["username"].', ou=People, DC=stuba, DC=sk';
            $password = $_POST["password"];
            $ldapconn = ldap_connect("ldap.stuba.sk");

            if($ldapconn) {
                $ldapbind = ldap_bind($ldapconn, $username, $password);
                if($ldapbind) {

                } else {
                    $this->app->flash('error_message','Zadali ste nespravne meno alebo heslo.');
                    $this->app->redirect($this->app->urlFor('login'));
                }
            } else {
                //@TODO add flash msg
                $this->app->flash('error_message','Server LDAP je momentalne mimo prevadzky.');
                $this->app->response->redirect($this->app->urlFor('login'));
            }
        } else {
            $this->app->flash('error_message','Zadali ste nespravne meno alebo heslo.');
            $this->app->redirect($this->app->urlFor('login'));
        }

    }

    public function loginGoogle() {

    }
    public function check() {

    }
    public static function logout() {
        return 'logout';
    }
}