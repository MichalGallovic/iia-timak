<?php namespace IIA\service\repositories;

class UsersRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('users');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('users');
    }
    
    public function getByRoleId($roleId) {
        $this->databaseConnector->where('role_id', $roleId);
        return $this->databaseConnector->get('users');
    }
    
    public function getByFirstName($firstName) {
        $this->databaseConnector->where('firstname', $firstName);
        return $this->databaseConnector->get('users');
    }
    
    public function getBySurName($surName) {
        $this->databaseConnector->where('surname', $surName);
        return $this->databaseConnector->get('users');
    }
    
    public function getByTitle1($title1) {
        $this->databaseConnector->where('title1', $title1);
        return $this->databaseConnector->get('users');
    }
    
    public function getByTitle2($title2) {
        $this->databaseConnector->where('title2', $title2);
        return $this->databaseConnector->get('users');
    }
    
    public function getByGroupId($groupId) {
        $this->databaseConnector->where('group_id', $groupId);
        return $this->databaseConnector->get('users');
    }
    
    public function getByLdap($ldap) {
        $this->databaseConnector->where('ldap', $ldap);
        return $this->databaseConnector->get('users');
    }
    
    public function getByGoogle($google) {
        $this->databaseConnector->where('google', $google);
        return $this->databaseConnector->get('users');
    }
}

?>