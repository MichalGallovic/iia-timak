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
            'day' => '',
            'type' => '',
            'subjectName' => '',
            'userName' => '',
            'userSurName' => '',
            'startTime' => '',
            'endTime' => '',
            'roomName' => '',
            'note' => ''
        );

        $type = $this->request['type'];
        $id = $this->request['id'];
        switch ($type) {
            case 'user':
            case 'uzivatel':
                return $this->getUserSchedule($retArray, $rowStructure, $id);

            case 'users_group':
            case 'skupina_uzivatelov':
                $this->getUserSchedule($retArray, $rowStructure, $id);
                $id = 1;
                $maxId = 10;
                while (true && $id < $maxId) {
                    $optId = 'id' . $id;
                    if (!isset($this->request[$optId]))
                        break;
                    $this->getUserSchedule($retArray, $rowStructure, $optId);
                    $id+=1;
                }
                return $retArray;

            case 'subject':
            case 'predmet':
                return $this->getSubjectSchedule($retArray, $rowStructure, $id);

            case 'room':
            case 'miestnost':
                return $this->getRoomSchedule($retArray, $rowStructure, $id);

            case 'day':
            case 'den':
                return $this->getDaySchedule($retArray, $rowStructure, $id);

            case 'group':
            case 'oddelenie':
                return $this->getGroupSchedule($retArray, $rowStructure, $id);

            default:
                return array();
        }
    }

    protected function getUserSchedule($retArray, $rowStructure, $userId) {
        //  getni vseky prednasky
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'consultations');

        return $retArray;
    }

    protected function getUserPartSchedule($retArray, $rowStructure, $userId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByUserId($userId);
                break;
            case 'exercises':
                $type = 'exercises';
                $samples = $this->exercisesRepository->getByUserId($userId);
                break;
            case 'consultations':
                $type = 'consultations';
                $samples = $this->consultationsRepository->getByUserId($userId);
                break;
            default:
                return array();
        }

        $user = $this->usersRepository->getById($userId);
        if (empty($user)) {
            return array();   //  ak sa user s danym id nenachadza v database, vrati prazdne pole
        }

        //  natiahni si zakladne info o uzivatelovi
        $userName = $user['firstname'];
        $userSurName = $user['surname'];

        //  natiahni si potrebne info o predmete
        foreach ($samples as $sample) {
            $startTime = $sample['start_time'];
            $endTime = $sample['end_time'];
            $day = $sample['day'];

            //  skontroluj ci je dany predmet validny - boli zadefinovane aj prednaska aj cviko + miestnosti
            $subjectId = $sample['subject_id'];
            //if ($this->checkSubjectValid($subjectId) == false) {
            //    continue;
            //}
            //   natiahni si potrebne info o miestnosti
            $roomId = $sample['room_id'];
            $room = $this->roomsRepository->getById($roomId);
            $roomName = $room['name'];

            //  natiahni si potrebne info o predmete
            $subject = $this->subjectsRepository->getById($subjectId);
            $subjectName = $subject['name'];

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    protected function getSubjectSchedule($retArray, $rowStructure, $subjectId) {
        //  getni vseky prednasky
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'consultations');

        return $retArray;
    }

    protected function getSubjectPartSchedule($retArray, $rowStructure, $subjectId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getBySubjectId($subjectId);
                break;
            case 'exercises':
                $type = 'exercises';
                $samples = $this->exercisesRepository->getBySubjectId($subjectId);
                break;
            case 'consultations':
                $type = 'consultations';
                $samples = $this->consultationsRepository->getBySubjectId($subjectId);
                break;
            default:
                return array();
        }

        /*
          if ($this->checkSubjectValid($subjectId) == false) {
          return array();
          }
         */

        //  natiahni si potrebne info o predmete
        $subject = $this->subjectsRepository->getById($subjectId);
        $subjectName = $subject['name'];

        //  prejdi vsetky vzorky (prednasky, cvicenie alebo konzultacie) podla dna v tyzdni
        foreach ($samples as $sample) {
            $startTime = $sample['start_time'];
            $endTime = $sample['end_time'];
            $day = $sample['day'];

            //  natiahni si potrebne info o uzivatelovi
            $userId = $sample['user_id'];
            $user = $this->usersRepository->getById($userId);
            $userName = $user['firstname'];
            $userSurName = $user['surname'];

            //   natiahni si potrebne info o miestnosti
            $roomId = $sample['room_id'];
            $room = $this->roomsRepository->getById($roomId);
            $roomName = $room['name'];

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    protected function getRoomSchedule($retArray, $rowStructure, $roomId) {
        //  getni vseky prednasky
        $reArray = $this->getRoomPartSchedule($rowStructure, $roomId, 'lectures');

        //  getni vseky cvika
        $reArray = $this->getRoomPartSchedule($rowStructure, $roomId, 'exercises');

        //  getni vseky konzultacie
        $reArray = $this->getRoomPartSchedule($rowStructure, $roomId, 'consultations');

        return $retArray;
    }

    protected function getRoomPartSchedule($retArray, $rowStructure, $roomId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByRoomId($roomId);
                break;
            case 'exercises':
                $type = 'exercises';
                $samples = $this->exercisesRepository->getByRoomId($roomId);
                break;
            case 'consultations':
                $type = 'consultations';
                $samples = $this->consultationsRepository->getByRoomId($roomId);
                break;
            default:
                return array();
        }

        //  natiahni si potrebne info o predmete
        $room = $this->roomsRepository->getById($roomId);
        $roomName = $room['name'];

        //  prejdi vsetky vzorky (prednasky, cvicenie alebo konzultacie) podla dna v tyzdni
        foreach ($samples as $sample) {

            $startTime = $sample['start_time'];
            $endTime = $sample['end_time'];
            $day = $sample['day'];

            $subjectId = $sample['subject_id'];
            /*
              //  skontroluj ci je dany predmet validny - boli zadefinovane aj prednaska aj cviko + miestnosti
              if ($this->checkSubjectValid($subjectId) == false) {
              continue;
              }
             */

            //  natiahni si potrebne info o predmete
            $subject = $this->subjectsRepository->getById($subjectId);
            $subjectName = $subject['name'];

            //  natiahni si potrebne info o uzivatelovi
            $userId = $sample['user_id'];
            $user = $this->usersRepository->getById($userId);
            $userName = $user['firstname'];
            $userSurName = $user['surname'];

            //  napln pole ziskanymi udajmi
            $rowStructure['day'] = $day;
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    protected function getDaySchedule($retArray, $rowStructure, $day) {
        //  getni vseky prednasky
        $reArray = $this->getDayPartSchedule($rowStructure, $day, 'lectures');

        //  getni vseky cvika
        $reArray = $this->getDayPartSchedule($rowStructure, $day, 'exercises');

        //  getni vseky konzultacie
        $reArray = $this->getDayPartSchedule($rowStructure, $day, 'consultations');

        return $retArray;
    }

    protected function getDayPartSchedule($retArray, $rowStructure, $day, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByDay($day);
                break;
            case 'exercises':
                $type = 'exercises';
                $samples = $this->exercisesRepository->getByDay($day);
                break;
            case 'consultations':
                $type = 'consultations';
                $samples = $this->consultationsRepository->getByDay($day);
                break;
            default:
                return array();
        }

        //  prejdi vsetky vzorky (prednasky, cvicenie alebo konzultacie) podla dna v tyzdni
        foreach ($samples as $sample) {

            $startTime = $sample['start_time'];
            $endTime = $sample['end_time'];
            $roomId = $sample['room_id'];

            $subjectId = $sample['subject_id'];
            /*
              //  skontroluj ci je dany predmet validny - boli zadefinovane aj prednaska aj cviko + miestnosti
              if ($this->checkSubjectValid($subjectId) == false) {
              continue;
              }
             */

            //  natiahni si potrebne info o predmete
            $subject = $this->subjectsRepository->getById($subjectId);
            $subjectName = $subject['name'];

            //  natiahni si potrebne info o uzivatelovi
            $userId = $sample['user_id'];
            $user = $this->usersRepository->getById($userId);
            $userName = $user['firstname'];
            $userSurName = $user['surname'];

            //  natiahni si potrebne info o predmete
            $room = $this->roomsRepository->getById($roomId);
            $roomName = $room['name'];

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    protected function getGroupSchedule($retArray, $rowStructure, $groupId) {
        $users = $this->usersRepository->getByGroupId($groupId);
        if (empty($users)) {
            return array();
        }

        foreach ($users as $user) {
            $userId = $user['id'];
            
            //  getni vseky prednasky
            $reArray = $this->getUserPartSchedule($rowStructure, $userId, 'lectures');

            //  getni vseky cvika
            $reArray = $this->getUserPartSchedule($rowStructure, $userId, 'exercises');

            //  getni vseky konzultacie
            $reArray = $this->getUserPartSchedule($rowStructure, $userId, 'consultations');
        }

        return $retArray;
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