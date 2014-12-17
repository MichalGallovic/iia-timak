<?php
require_once 'API.class.php';
require_once 'functions.php';

class MyAPI extends API {

    protected $User;

    public function __construct($request, $origin) {
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

}

?>