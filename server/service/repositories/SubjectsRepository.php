<?php

require '../../vendor/autoload.php';

class SubjectsRepository {

    protected $databaseConnector;

    public function __construct() {
        $credentials = getDbCredentias();
        $this->databaseConnector = new MysqliDb($credentials['host'], $credentials['username'], $credentials['password'], $credentials['dbName']);
    }

    public function getAll() {
        return $this->databaseConnector->get('subjects');
    }

    public function getById($id) {
        $this->databaseConnector->where('id', $id);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByCode($code) {
        $this->databaseConnector->where('code', $code);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByTerm($term) {
        $this->databaseConnector->where('term', $term);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByAcronym($acronym) {
        $this->databaseConnector->where('acronym', $acronym);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByLectureDuration($lectureDuration) {
        $this->databaseConnector->where('lecture_duration', $lectureDuration);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByExerciseDuration($exerciseDuration) {
        $this->databaseConnector->where('exercise_duration', $exerciseDuration);
        return $this->databaseConnector->get('subjects');
    }
    
    public function getByColor($color) {
        $this->databaseConnector->where('color', $color);
        return $this->databaseConnector->get('subjects');
    }
}
?>

