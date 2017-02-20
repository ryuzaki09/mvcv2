<?php
namespace src\Controllers;

use System\Core;

class BaseController extends Core {

    public function __construct(){
        parent::__construct();
    }



    protected function filterVar($input){
        if( isset($input) && is_string($input))
            return trim(filter_var($input, FILTER_SANITIZE_STRING));

        if(isset($input) && is_numeric($input) )
            return trim(filter_var($input, FILTER_SANITIZE_NUMBER_INT));
    }


    protected function filterPostInput($input){
        if(isset($_POST[$input]) && is_string($_POST[$input]))
            return trim(filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING));

        if(isset($_POST[$input]) && is_numeric($_POST[$input]))
            return trim(filter_input(INPUT_POST, $input, FILTER_SANITIZE_NUMBER_INT));

    }

}
