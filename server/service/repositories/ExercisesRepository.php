<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/iia_timak/vendor/Mysql/MysqliDb.php';

class SubjectsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = include $_SERVER['DOCUMENT_ROOT'] . 'iia_timak/configs/database.php';
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('exercises');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('exercises');
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
}

?>
