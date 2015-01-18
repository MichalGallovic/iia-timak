<?php namespace IIA\service\repositories;

class LecturesRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }
    
    public function getAll() {
        return $this->databaseConnector->get('lectures');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->getOne('lectures');
    }
    
    public function getBySubjectId($subjectId) {
        $this->databaseConnector->where('subject_id', $subjectId);
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
    
    public function getByStartTime($startTime) {
        $this->databaseConnector->where('start_time', $startTime);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByEndTime($endTime) {
        $this->databaseConnector->where('end_time', $endTime);
        return $this->databaseConnector->get('lectures');
    }
    
    public function getByDay($day) {
        $this->databaseConnector->where('day', $day);
        return $this->databaseConnector->get('lectures');
    }

}

?>
