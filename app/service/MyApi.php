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
            if (isset($this->request['term'])) {
                $term = $this->request['term'];
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

    protected function schedule() {
        if ($this->method != 'GET')
            return array();
        if (!isset($this->request['type']) || !isset($this->request['id']))
            return array();

//  navratove pole
        $retArray = array();

//  struktura jedneho riadku navratoho pola
        $rowStructure = array(
            'type' => '',
            'subjectName' => '',
            'teacherName' => '',
            'teacherSurName' => '',
            'day' => '',
            'startTime' => '',
            'endTime' => '',
            'roomName' => ''
        );

        $type = $this->request['type'];
        $id = $this->request['id'];
        switch ($type) {
            case 'teacher':
            case 'ucitel':
                $user = $this->usersRepository->getById($id);
                if (empty($user)) {
                    return $retArray;   //  ak sa user s danym id nenachadza v database, vrati prazdne pole
                }
                
                //  natiahni si zakladne info o ucitelovi
                $teacherId = $user['id'];
                $teacherName = $user['firstname'];
                $teacherSurName = $user['surname'];

                //  prejdi vsetky prednasky s id-ckom daneho ucitela
                $lectures = $this->lecturesRepository->getByUserId($teacherId);
                foreach ($lectures as $lecture) {
                    $type = 'lecture';
                    $startTime = $lecture['start_time'];
                    $endTime = $lecture['end_time'];
                    $day = $lecture['day'];

                    //  skontroluj ci je dany predmet validny - boli zadefinovane aj prednaska aj cviko + miestnosti
                    $subjectId = $lecture['subject_id'];
                    if ($this->checkSubjectValid($subjectId) == false) {
                        continue;
                    }

                    //   natiahni si potrebne info o miestnosti
                    $roomId = $lecture['room_id'];
                    $room = $this->roomsRepository->getById($exerciseRoomId);
                    $roomName = $room['name'];
                    
                    //  natiahni si potrebne info o predmete
                    $subject = $this->subjectsRepository->getById($subjectId);
                    $subjectName = $subject['name'];

                    //  napln pole ziskanymi udajmi
                    $rowStructure['type'] = $type;
                    $rowStructure['subjectName'] = $subjectName;
                    $rowStructure['teacherName'] = $teacherName;
                    $rowStructure['teacherSurName'] = $teacherSurName;
                    $rowStructure['day'] = $day;
                    $rowStructure['startTime'] = $startTime;
                    $rowStructure['endTime'] = $endTime;
                    $rowStructure['roomName'] = $roomName;
                    
                    //  pridaj riadok do navratoveho pola
                    array_push($retArray, $rowStructure);
                }
                return $retArray;

            case 'teachers_group':
            case 'skupina_ucitelov':
                return 'teachers_group';
                break;

            case 'subject':
            case 'predmet':
                return 'subject';
                break;

            case 'room':
            case 'miestnost':
                return 'room';
                break;

            case 'day':
            case 'den':
                return 'room';
                break;

            case 'group':
            case 'oddelenie':
                return 'group';
                break;

            default:
                return array();
        }
    }

    protected function subjectValid() {
        if ($this->method != 'GET') {
            return array();
        }
        if (!isset($this->request['id'])) {
            return array();
        }

        $id = $this->request['id'];
        if ($this->checkSubjectValid($id) == true) {
            return array('valid' => 'true');
        } else {
            return array('valid' => 'false');
        }
    }

//  fcia skontroluje ci je danemu predmetu priradena prednaska + cviko, ak ano vrati true, inak false
    protected function checkSubjectValid($subjectId) {
        $subject = $this->subjectsRepository->getById($subjectId);
        $lectures = $this->lecturesRepository->getBySubjectId($subjectId);
        $exercises = $this->exercisesRepository->getBySubjectId($subjectId);
        if (empty($subject) || empty($lectures) || empty($exercises)) {    //  niesu zadefinove predmet, prednasky + cvika pre dany predmet
            return false;
        }

//  este skontroluj ci ma prednaska a cvika zadefinovanu miestnost a tato miestnost existuje(v databaze)
        foreach ($lectures as $lecture) {
            $lectureRoomId = $lecture['room_id'];
            $lectureRoom = $this->roomsRepository->getById($lectureRoomId);
            if (empty($lectureRoom)) {
                return false;
            }
        }

        foreach ($exercises as $exercise) {
            $exerciseRoomId = $exercise['room_id'];
            $exerciseRoom = $this->roomsRepository->getById($exerciseRoomId);
            if (empty($exerciseRoom)) {
                return false;
            }
        }

        return true;
    }

}
?>