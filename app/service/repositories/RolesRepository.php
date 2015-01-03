<?php namespace IIA\service\repositories;

class RolesRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('roles');
    }
    
    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('roles');
    }

    public function getByName($name) {
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('roles');
    }
    
    public function getByCreate($create) {
        $this->databaseConnector->where('create', $create);
        return $this->databaseConnector->get('roles');
    }
    
    public function getByRead($read) {
        $this->databaseConnector->where('read', $read);
        return $this->databaseConnector->get('roles');
    }   
    
    public function getByUpdate($update) {
        $this->databaseConnector->where('update', $update);
        return $this->databaseConnector->get('roles');
    }
    
    public function getByDelete($delete) {
        $this->databaseConnector->where('delete', $delete);
        return $this->databaseConnector->get('roles');
    }
}

?>
