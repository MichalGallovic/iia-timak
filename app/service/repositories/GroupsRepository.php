<?php namespace IIA\service\repositories;

class GroupsRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('groups');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('groups');
    }
    
    public function getByCode($code) {
        $this->databaseConnector->where('code', $code);
        return $this->databaseConnector->get('groups');
    }
    
    public function getByName($name) {
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('groups');
    }
    
}

?>
