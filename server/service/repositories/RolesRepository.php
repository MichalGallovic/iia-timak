<?php

require '../../vendor/autoload.php';

class SubjectsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = getDbCredentias();
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
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
    
    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('roles');
    }
}

?>
