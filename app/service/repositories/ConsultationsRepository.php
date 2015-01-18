<?php namespace IIA\service\repositories;


class ConsultationsRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }

    public function getAll() {
        return $this->databaseConnector->get('consultations');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->getOne('consultations');
    }
    
    public function getByUserId($id) {
        $this->databaseConnector->where('user_id', $id);
        return $this->databaseConnector->get('consultations');
    }
    
    public function getByRoomId($id) {
        $this->databaseConnector->where('room_id', $id);
        return $this->databaseConnector->get('consultations');
    }
    
    public function getBySubjectId($id) {
        $this->databaseConnector->where('subject_id', $id);
        return $this->databaseConnector->get('consultations');
    }

    public function getByName($name) {
        $this->databaseConnector->where('name', $name);
        return $this->databaseConnector->get('consultations');
    }
    
    public function getByDay($day) {
        $this->databaseConnector->where('day', $day);
        return $this->databaseConnector->get('consultations');
    }
}

