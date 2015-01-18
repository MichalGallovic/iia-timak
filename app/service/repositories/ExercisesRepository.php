<?php namespace IIA\service\repositories;

class ExercisesRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('exercises');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->getOne('exercises');
    }
    
    public function getByDateTime($dateTime) {
        $this->databaseConnector->where('date_time', $dateTime);
        return $this->databaseConnector->get('exercises');
    }
    
    public function getBySubjectId($subjectId) {
        $this->databaseConnector->where('subject_id', $subjectId);
        return $this->databaseConnector->get('exercises');
    }
    
    public function getByUserId($userId) {
        $this->databaseConnector->where('user_id', $userId);
        return $this->databaseConnector->get('exercises');
    }   
    
    public function getByRoomId($roomId) {
        $this->databaseConnector->where('room_id', $roomId);
        return $this->databaseConnector->get('exercises');
    }
    
    public function getByDay($day) {
        $this->databaseConnector->where('day', $day);
        return $this->databaseConnector->get('exercises');
    }
    
}