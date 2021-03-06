<?php

namespace System;

class Router {
	private $routes;

	const DEFAULT_URI = "/";
	const DEFAULT_ROUTE = "UserController@Index";

    public function __construct()
    {
		$this->routes = include dirname(__DIR__)."/src/routes.php";
	}

    public function Index()
    {
		$req_method = strtolower($_SERVER['REQUEST_METHOD']);
		$request_uri = $_SERVER['REQUEST_URI'];

        //check routes
		if (isset($this->routes[$req_method]) && !empty($this->routes[$req_method])){
            foreach ($this->routes[$req_method] as $uri => $route) :
                //hit first matching route then break loop
                if ($request_uri == $uri){
                    $req_route = $route;
                    break;
                }
            endforeach;
		}

        //check if request uri is default uri
		if ($request_uri == self::DEFAULT_URI){
            $req_route = self::DEFAULT_ROUTE;
		}

        //check if req_route is set
		if (!isset($req_route)){
			echo "No Route!";
			exit;
		}

        //begin to call the class and method
        try {
            $parts = explode("@", $req_route);
            $controller = $parts[0];
            $class = "\src\Controllers\\$controller";
            $myclass = new $class;

            if ($req_method == "post")
                $myclass->{$parts[1]}(new Request);
            else
                $myclass->{$parts[1]}();
        } catch(Exception $e) {
            echo $e->getMessage();

        }



	}

}
