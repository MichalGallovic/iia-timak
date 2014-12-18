<?php namespace IIA\service;

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

    /**
     * Example of an Endpoint
     */
    protected function example() {
        $retStr = "Method: " . $this->method . "; "
                . "Endpoint: " . $this->endpoint . "; "
                . "args count: " . count($this->args) . "; "
                . "Arg 0: " . $this->args[0] . "; "
                . "Request: " . $this->request . "; ";
        if ($this->method == 'GET') {
            $state = $this->request["state"];
            if (isset($state)) {
                //return $meniny->allRedLetterDays($state);
                $retStr .= "ConstState: " . $state . " ";
            }
            $date = $this->request["date"];
            if (isset($date)) {
                //return $meniny->allRedLetterDays($state);
                $retStr .= "ConstDate: " . $date . " ";
            }
        }
        return $retStr;
    }

    protected function subjects() {
        if ($this->method == 'GET') {
//            $term = $this->request["term"];
//            if (isset($term)) {
//                return $this->subjectsRepository->getByTerm($term);
//            }

            return $this->subjectsRepository->getAll();
        }
    }
    
    protected function users() {
        if ($this->method == 'GET') {
            return $this->usersRepository->getAll();
        }
    }

}

?>