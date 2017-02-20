<?php

namespace System;
use System\Router;
class Core {

    public function __construct(){
        $this->start();
        $this->Loader();

    }

	public function Index(){

		$router = new Router;
		$router->Index();

	}
	

    private function Loader(){

        $config = include "system/configs/Config.php";

        foreach($config['autoload'] AS $name => $class):
            $class_replaced = str_replace("\\", "/", $class);
            $filepath = dirname(__DIR__)."/".$class_replaced.".php";
            if (file_exists($filepath)){
                require_once $filepath;
                $this->{$name} = new $class;
            }

        endforeach;

        foreach ($config['defaults'] AS $default):
            $replaced = str_replace("\\", "/", $default);
            if (file_exists(dirname(__DIR__)."/".$replaced.".php")) {
                    require_once lcfirst(dirname(__DIR__)."/".$replaced.".php");

            }

        endforeach;

    }

    private function start(){
        ob_start();
    }

}
