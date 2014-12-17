<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/iia_timak/vendor/Mysql/MysqliDb.php';

class SubjectsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = include $_SERVER['DOCUMENT_ROOT'] . 'iia_timak/configs/database.php';
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('lectures');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getBySubjectId($subjectId) {
        $this->databaseConnector->where('subject_id', $subjectId);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByStartTime($startTime) {
        $this->databaseConnector->where('start_time', $startTime);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByEndTime($endTime) {
        $this->databaseConnector->where('end_time', $endTime);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByUserId($userId) {
        $this->databaseConnector->where('user_id', $userId);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByRoomId($roomId) {
        $this->databaseConnector->where('room_id', $roomId);
        return $this->databaseConnector->get('lectures');
    }
}

?>
