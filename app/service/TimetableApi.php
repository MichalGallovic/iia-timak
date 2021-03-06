<?php

namespace IIA\service;

use IIA\service\API as API;
use IIA\service\repositories\ConsultationsRepository;
use IIA\service\repositories\ExercisesRepository;
use IIA\service\repositories\GroupsRepository;
use IIA\service\repositories\LecturesRepository;
use IIA\service\repositories\RolesRepository;
use IIA\service\repositories\RoomsRepository;
use IIA\service\repositories\SubjectsRepository;
use IIA\service\repositories\UsersRepository;

class TimetableApi extends API {

    protected $consultationsRepository;
    protected $exercisesRepository;
    protected $groupsRepository;
    protected $lecturesRepository;
    protected $rolesRepository;
    protected $roomsRepository;
    protected $subjectsRepository;
    protected $usersRepository;

    public function __construct($request, $dbCredentials) {
        parent::__construct($request);
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
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->consultationsRepository->getById($id);
        }
        return $this->consultationsRepository->getAll();
    }

    protected function exercises() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->exercisesRepository->getById($id);
        }
        return $this->exercisesRepository->getAll();
    }

    protected function groups() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->groupsRepository->getById($id);
        }
        return $this->groupsRepository->getAll();
    }

    protected function lectures() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->lecturesRepository->getById($id);
        }
        return $this->lecturesRepository->getAll();
    }

    protected function roles() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->rolesRepository->getById($id);
        }
        return $this->rolesRepository->getAll();
    }

    protected function subjects() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->subjectsRepository->getById($id);
        }
        if (isset($this->request['term'])) {
            $term = $this->request['term'];
            return $this->subjectsRepository->getByTerm($term);
        }
        return $this->subjectsRepository->getAll();
    }

    protected function users() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->usersRepository->getById($id);
        }
        return $this->usersRepository->getAll();
    }

    protected function rooms() {
        if ($this->method != 'GET') {
            return array();
        }
        if (isset($this->request['id'])) {
            $id = $this->request['id'];
            return $this->roomsRepository->getById($id);
        }
        return $this->roomsRepository->getAll();
    }

    protected function usersHours() {
        if ($this->method != 'GET') {
            return array();
        }
        if (!isset($this->request['orderedBy']) || !isset($this->request['orderedMode'])) {
            return array();
        }

        $orderedBy = $this->request['orderedBy'];
        $orderedMode = $this->request['orderedMode'];

        $retArray = array();
        $rowStructure = array(
            'fullName' => '',
            'lectureHours' => '',
            'exerciseHours' => '',
            'totalHours' => '',
        );

        $users = $this->usersRepository->getAll();
        foreach ($users as $user) {
            $userId = $user['id'];
            $fullName = $user['firstname'] . ' ' . $user['surname'];

            $lectures = $this->lecturesRepository->getByUserId($userId);
            $lectureHours = 0;
            foreach ($lectures as $lecture) {
                $lecTimeDiff = $lecture['end_time'] - $lecture['start_time'];
                $lectureHours += $lecTimeDiff;
            }

            $exercises = $this->exercisesRepository->getByUserId($userId);
            $exerciseHours = 1;
            foreach ($exercises as $exercise) {
                $exerTimeDiff = $exercise['end_time'] - $exercise['start_time'];
                $exerciseHours += $exerTimeDiff;
            }

            $totalHours = $lectureHours + $exerciseHours;

            $rowStructure['fullName'] = $fullName;
            $rowStructure['lectureHours'] = $lectureHours;
            $rowStructure['exerciseHours'] = $exerciseHours;
            $rowStructure['totalHours'] = $totalHours;
            array_push($retArray, $rowStructure);
        }

        switch ($orderedMode) {
            case 'asc':
                $orderedMode = SORT_ASC;
                break;
            case 'desc':
                $orderedMode = SORT_DESC;
                break;
        }

        switch ($orderedBy) {
            case 'fullName':
                $retArray = $this->array_msort($retArray, array('fullName' => $orderedMode));
                break;
            case 'lectureHours':
                $retArray = $this->array_msort($retArray, array('lectureHours' => $orderedMode));
                break;
            case 'exerciseHours':
                $retArray = $this->array_msort($retArray, array('exerciseHours' => $orderedMode));
                break;
            case 'totalHours':
                $retArray = $this->array_msort($retArray, array('totalHours' => $orderedMode));
                break;
            default:
                return array();
        }
        
        //  prepis array do spravnej struktury
        $prepisaneArray = [];
        foreach($retArray as $part) {
            array_push($prepisaneArray,$part);
        }

        return $prepisaneArray;
    }

    private function array_msort($array, $cols) {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_' . $k] = strtolower($row[$col]);
            }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
        }
        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$k]))
                    $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }

    protected function schedule() {
        if ($this->method != 'GET') {
            return array();
        }
        if (!isset($this->request['type']) || !isset($this->request['id'])) {
            return array();
        }

        //  navratove pole
        $retArray = array();

        //  struktura jedneho riadku navratoho pola
        $rowStructure = array(
            'day' => '',
            'type' => '',
            'subjectName' => '',
            'subjectAcronym' => '',
            'color' => '',
            'userName' => '',
            'userSurName' => '',
            'userTitle1' => '',
            'userTitle2' => '',
            'startTime' => '',
            'endTime' => '',
            'roomName' => '',
            'note' => ''
        );

        $type = $this->request['type'];
        $id = $this->request['id'];
        switch ($type) {
            case 'user':
            case 'ucitel':
            case 'uzivatel':
                return $this->getUserSchedule($retArray, $rowStructure, $id);

            case 'users_group':
            case 'skupina_ucitelov':
            case 'skupina_uzivatelov':
                $retArray = $this->getUserSchedule($retArray, $rowStructure, $id);
                $maxId = 10;
                for ($id = 0; $id < $maxId; $id++) {
                    $optId = 'id' . $id;
                    if (!isset($this->request[$optId])) {
                        continue;
                    }
                    $id = $this->request[$optId];
                    $retArray = $this->getUserSchedule($retArray, $rowStructure, $id);
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

    private function getUserSchedule($retArray, $rowStructure, $userId) {
        //  getni vseky prednasky
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'consultations');

        return $retArray;
    }

    private function getUserPartSchedule($retArray, $rowStructure, $userId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByUserId($userId);
                $isConsultation = false;
                break;
            case 'exercises':
                $type = 'exercise';
                $samples = $this->exercisesRepository->getByUserId($userId);
                $isConsultation = false;
                break;
            case 'consultations':
                $type = 'consultation';
                $samples = $this->consultationsRepository->getByUserId($userId);
                $isConsultation = true;
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
        $userTitle1 = $user['title1'];
        $userTitle2 = $user['title2'];

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
            $subjectAcronym = $subject['acronym'];
            $color = $subject['color'];

            //  natiahni si poznamku ku konzultaciam
            $note = '';
            if ($isConsultation == true) {
                $note = $sample['note'];
            }

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['color'] = $color;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['subjectAcronym'] = $subjectAcronym;
            $rowStructure['userTitle1'] = $userTitle1;
            $rowStructure['userTitle2'] = $userTitle2;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;
            $rowStructure['note'] = $note;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    private function getSubjectSchedule($retArray, $rowStructure, $subjectId) {
        //  getni vseky prednasky
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getSubjectPartSchedule($retArray, $rowStructure, $subjectId, 'consultations');

        return $retArray;
    }

    private function getSubjectPartSchedule($retArray, $rowStructure, $subjectId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getBySubjectId($subjectId);
                $isConsultation = false;
                break;
            case 'exercises':
                $type = 'exercise';
                $samples = $this->exercisesRepository->getBySubjectId($subjectId);
                $isConsultation = false;
                break;
            case 'consultations':
                $type = 'consultation';
                $samples = $this->consultationsRepository->getBySubjectId($subjectId);
                $isConsultation = true;
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
        $subjectAcronym = $subject['acronym'];
        $color = $subject['color'];

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
            $userTitle1 = $user['title1'];
            $userTitle2 = $user['title2'];

            //   natiahni si potrebne info o miestnosti
            $roomId = $sample['room_id'];
            $room = $this->roomsRepository->getById($roomId);
            $roomName = $room['name'];

            //  natiahni si poznamku ku konzultaciam
            $note = '';
            if ($isConsultation == true) {
                $note = $sample['note'];
            }

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['subjectAcronym'] = $subjectAcronym;
            $rowStructure['color'] = $color;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['userTitle1'] = $userTitle1;
            $rowStructure['userTitle2'] = $userTitle2;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;
            $rowStructure['note'] = $note;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    private function getRoomSchedule($retArray, $rowStructure, $roomId) {
        //  getni vseky prednasky
        $retArray = $this->getRoomPartSchedule($retArray, $rowStructure, $roomId, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getRoomPartSchedule($retArray, $rowStructure, $roomId, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getRoomPartSchedule($retArray, $rowStructure, $roomId, 'consultations');

        return $retArray;
    }

    private function getRoomPartSchedule($retArray, $rowStructure, $roomId, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByRoomId($roomId);
                $isConsultation = false;
                break;
            case 'exercises':
                $type = 'exercise';
                $samples = $this->exercisesRepository->getByRoomId($roomId);
                $isConsultation = false;
                break;
            case 'consultations':
                $type = 'consultation';
                $samples = $this->consultationsRepository->getByRoomId($roomId);
                $isConsultation = true;
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
            $subjectAcronym = $subject['acronym'];
            $color = $subject['color'];

            //  natiahni si potrebne info o uzivatelovi
            $userId = $sample['user_id'];
            $user = $this->usersRepository->getById($userId);
            $userName = $user['firstname'];
            $userSurName = $user['surname'];
            $userTitle1 = $user['title1'];
            $userTitle2 = $user['title2'];

            //  natiahni si poznamku ku konzultaciam
            $note = '';
            if ($isConsultation == true) {
                $note = $sample['note'];
            }

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['subjectAcronym'] = $subjectAcronym;
            $rowStructure['color'] = $color;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['userTitle1'] = $userTitle1;
            $rowStructure['userTitle2'] = $userTitle2;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;
            $rowStructure['note'] = $note;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    private function getDaySchedule($retArray, $rowStructure, $day) {
        //  getni vseky prednasky
        $retArray = $this->getDayPartSchedule($retArray, $rowStructure, $day, 'lectures');

        //  getni vseky cvika
        $retArray = $this->getDayPartSchedule($retArray, $rowStructure, $day, 'exercises');

        //  getni vseky konzultacie
        $retArray = $this->getDayPartSchedule($retArray, $rowStructure, $day, 'consultations');

        return $retArray;
    }

    private function getDayPartSchedule($retArray, $rowStructure, $day, $type) {
        switch ($type) {
            case 'lectures':
                $type = 'lecture';
                $samples = $this->lecturesRepository->getByDay($day);
                $isConsultation = false;
                break;
            case 'exercises':
                $type = 'exercise';
                $samples = $this->exercisesRepository->getByDay($day);
                $isConsultation = false;
                break;
            case 'consultations':
                $type = 'consultation';
                $samples = $this->consultationsRepository->getByDay($day);
                $isConsultation = true;
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
            $subjectAcronym = $subject['acronym'];
            $color = $subject['color'];

            //  natiahni si potrebne info o uzivatelovi
            $userId = $sample['user_id'];
            $user = $this->usersRepository->getById($userId);
            $userName = $user['firstname'];
            $userSurName = $user['surname'];
            $userTitle1 = $user['title1'];
            $userTitle2 = $user['title2'];

            //  natiahni si potrebne info o predmete
            $room = $this->roomsRepository->getById($roomId);
            $roomName = $room['name'];

            //  natiahni si poznamku ku konzultaciam
            $note = '';
            if ($isConsultation == true) {
                $note = $sample['note'];
            }

            //  napln pole ziskanymi udajmi
            $rowStructure['type'] = $type;
            $rowStructure['subjectName'] = $subjectName;
            $rowStructure['subjectAcronym'] = $subjectAcronym;
            $rowStructure['color'] = $color;
            $rowStructure['userName'] = $userName;
            $rowStructure['userSurName'] = $userSurName;
            $rowStructure['userTitle1'] = $userTitle1;
            $rowStructure['userTitle2'] = $userTitle2;
            $rowStructure['day'] = $day;
            $rowStructure['startTime'] = $startTime;
            $rowStructure['endTime'] = $endTime;
            $rowStructure['roomName'] = $roomName;
            $rowStructure['note'] = $note;

            //  pridaj riadok do navratoveho pola
            array_push($retArray, $rowStructure);
        }

        return $retArray;
    }

    private function getGroupSchedule($retArray, $rowStructure, $groupId) {
        $users = $this->usersRepository->getByGroupId($groupId);
        if (empty($users)) {
            return array();
        }

        foreach ($users as $user) {
            $userId = $user['id'];

            //  getni vseky prednasky
            $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'lectures');

            //  getni vseky cvika
            $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'exercises');

            //  getni vseky konzultacie
            $retArray = $this->getUserPartSchedule($retArray, $rowStructure, $userId, 'consultations');
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
    private function checkSubjectValid($subjectId) {
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
