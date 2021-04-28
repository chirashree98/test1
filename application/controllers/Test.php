<?php

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['to']               = 'test@test.com';
        $data['subject']          = 'Welkom bij Profiwash Test';
        $data['email_template']   = 'new-account';
        $data['dear_name']        = 'Test';
        $data['url']              = 'www.google.com';

        $result = send_mail($data);
        if($result){
         echo 'Yes';
        }else{
           echo 'No';
        }

    }

}

// end of class
?>