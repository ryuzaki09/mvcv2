<?php
namespace System;

class Request {

    public $request;

    public function __construct(){
        $this->request = new \stdClass();
        $this->request->method  = $_SERVER['REQUEST_METHOD']; 
        $this->request->uri     = $_SERVER['REQUEST_URI']; 

    }

    public function Index(){


    }

}
