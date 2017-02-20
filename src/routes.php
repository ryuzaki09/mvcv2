<?php


return  [

	"get" => [
        "/user/create-user" => "UserController@CreateUser",
        "/user/update-user" => "UserController@UpdateUser",

			],
	"post" => [
        "/user/process-create" => "UserController@ProcessCreate",
        "/user/process-update" => "UserController@ProcessUpdate",


			]


];
