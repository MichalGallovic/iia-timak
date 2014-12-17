<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/iia_timak/vendor/Mysql/MysqliDb.php';

class ConsultationsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = include $_SERVER['DOCUMENT_ROOT'] . 'iia_timak/configs/database.php';
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('consultations');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('consultations');
    }
    
    public function getByName($name) {
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('consultations');
    }
}

?>
