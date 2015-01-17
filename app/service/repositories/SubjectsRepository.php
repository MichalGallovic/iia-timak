<?php namespace IIA\service\repositories;

class SubjectsRepository implements DbRepositoryInterface{

    protected $databaseConnector;

    public function __construct($dbCredentials)
    {
        $this->databaseConnector = new \MysqliDb($dbCredentials['host'], $dbCredentials['username'],
            $dbCredentials['password'], $dbCredentials['dbName']);
    }

    public function getAll() {
        $this->databaseConnector->orderBy("name","asc");
        return $this->databaseConnector->get('subjects');
    }

    public function getById($id) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByCode($code) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('code', $code);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByTerm($term) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('term', $term);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByAcronym($acronym) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('acronym', $acronym);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByLectureDuration($lectureDuration) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('lecture_duration', $lectureDuration);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByExerciseDuration($exerciseDuration) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('exercise_duration', $exerciseDuration);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByColor($color) {
        $this->databaseConnector->orderBy("name","asc");
        $this->databaseConnector->where('color', $color);
        return $this->databaseConnector->get('subjects');
    }
}
?>

