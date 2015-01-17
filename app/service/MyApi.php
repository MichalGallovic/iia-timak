<?php

namespace IIA\service;

use IIA\service\API;
use IIA\service\repositories\ConsultationsRepository;
use IIA\service\repositories\ExercisesRepository;
use IIA\service\repositories\GroupsRepository;
use IIA\service\repositories\LecturesRepository;
use IIA\service\repositories\RolesRepository;
use IIA\service\repositories\RoomsRepository;
use IIA\service\repositories\SubjectsRepository;
use IIA\service\repositories\UsersRepository;

class MyAPI extends API {

    protected $consultationsRepository;
    protected $exercisesRepository;
    protected $groupsRepository;
    protected $lecturesRepository;
    protected $rolesRepository;
    protected $roomsRepository;
    protected $subjectsRepository;
    protected $usersRepository;
    protected $User;

    public function __construct($request, $dbCredentials) {
        parent::__construct($request);

        // Abstracted out for example
        #$APIKey = new Models\APIKey();
        #$User = new Models\User();

        $APIKey = 0;
        $User = 1;
        /*
          if (!array_key_exists('apiKey', $this->request)) {
          throw new Exception('No API Key provided');
          } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
          throw new Exception('Invalid API Key');
          } else if (array_key_exists('token', $this->request) &&
          !$User->get('token', $this->request['token'])) {

          throw new Exception('Invalid User Token');
          }
         */
        $this->User = $User;

        $this->consultationsRepository = new ConsultationsRepository($dbCredentials);
        $this->exercisesRepository = new ExercisesRepository($dbCredentials);
        $this->groupsRepository = new GroupsRepository($dbCredentials);
        $this->lecturesRepository = new LecturesRepository($dbCredentials);
        $this->rolesRepository = new RolesRepository($dbCredentials);
        $this->roomsRepository = new RoomsRepository($dbCredentials);
        $this->subjectsRepository = new SubjectsRepository($dbCredentials);
        $this->usersRepository = new UsersRepository($dbCredentials);
    }

    protected function consultations() {
        if ($this->method == 'GET') {
            return $this->consultationsRepository->getAll();
        }
    }
    
    protected function exercises() {
        if ($this->method == 'GET') {
            return $this->exercisesRepository->getAll();
        }
    }
    
    protected function groups() {
        if ($this->method == 'GET') {
            return $this->groupsRepository->getAll();
        }
    }
    
    protected function lectures() {
        if ($this->method == 'GET') {
            return $this->lecturesRepository->getAll();
        }
    }
    
    protected function roles() {
        if ($this->method == 'GET') {
            return $this->rolesRepository->getAll();
        }
    }

    protected function subjects() {
        if ($this->method == 'GET') {
            if (isset($this->request["term"])) {
                $term = $this->request["term"];
                return $this->subjectsRepository->getByTerm($term);
            }
            return $this->subjectsRepository->getAll();
        }
    }

    protected function users() {
        if ($this->method == 'GET') {
            return $this->usersRepository->getAll();
        }
    }
    
    protected function rooms() {
        if ($this->method == 'GET') {
            return $this->roomsRepository->getAll();
        }
    }

}

?>