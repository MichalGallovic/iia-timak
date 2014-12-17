<?php

require '../../vendor/autoload.php';

class SubjectsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = getDbCredentias();
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('rooms');
    }
    
    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('rooms');
    }

    public function getByName($name) {
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('rooms');
    }
}

?>
