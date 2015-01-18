<?php namespace IIA\service\repositories;

class RoomsRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        $this->databaseConnector->orderBy("name","asc");
        return $this->databaseConnector->get('rooms');
    }
    
    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->getOne('rooms');
    }

    public function getByName($name) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('rooms');
    }
}

?>
