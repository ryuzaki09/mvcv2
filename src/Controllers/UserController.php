<?php

namespace src\Controllers;
use System\Request;
use src\Models\User;
use src\Helpers\Ajax;

class UserController extends BaseController {
    
    const CRYPT_KEY = "suburb";

    public function __construct()
    {
        parent::__construct();
    }

    public function Index()
    {
        $user = new User;
        $data['user_types'] = $user->getRoles();
        $data['users'] = $user->getAllUsers();
        $data['title'] = "Create User";
        $data['js'] = ["/public/js/jquery.validate.min.js"];
        View::render("userform", $data);
	}

    public function ProcessCreate()
    {
        Ajax::is();

        $email = $this->filterPostInput("email");
        $username = $this->filterPostInput("username");

        $data = array("firstname"  => $this->filterPostInput("firstname"),
                    "lastname"   => $this->filterPostInput("lastname"),
                    "email"      => $email,
                    "user_type"   => $this->filterPostInput("userType"),
                    "username"   => $username,
                    "password"   => crypt($this->filterPostInput("pwd"), self::CRYPT_KEY)
                );

        try {
            $user = new User;
            $found = $user->findDuplicateUser($email, $username);

            if ($found) {
                $response['message'] = "Duplicate entry found. Email and username are unique.";
                return Ajax::sendResponse($response, false);
            }

            $result = $user->addUser($data);
            // error_log("result: ".var_export($result, true));
            if ($result) {
                $response['message'] = "User created";
                $response['html'] = "<tr><td>".$data['firstname']."</td>";
                $response['html'] .= "<td>".$data['lastname']."</td>";
                $response['html'] .= "<td>".$data['email']."</td>";
                $response['html'] .= "<td>".$data['user_type']."</td>";
                $response['html'] .= "<td>".$data['username']."</td>";
                $response['html'] .= "<td><button data-item='".$result."' class='edit'>Edit</button></td></tr>";
                Ajax::sendResponse($response);
            }
        } catch(\PDOException $e) {
            error_log("Error: ".$e->getMessage());
        }
    }

    public function ProcessUpdate()
    {
        Ajax::is();
        
        $password = $this->filterPostInput("pwd");
        $email = $this->filterPostInput("email");
        $username = $this->filterPostInput("username");
        $id = $this->filterPostInput("id");

        $data = array("firstname"  => $this->filterPostInput("firstname"),
                    "lastname"   => $this->filterPostInput("lastname"),
                    "email" => $email,
                    "user_type"   => $this->filterPostInput("userType"),
                    "username" => $username,
                );
        if ($password) {   
            $data['password'] = crypt($password, self::CRYPT_KEY);
        }

        try {
            $user = new User;
            $found = $user->findDuplicateUser($email, $username, " AND id NOT IN (".$id.")");

            if ($found) {
                $response['message'] = "Duplicate entry found. Email and username are unique.";
                return Ajax::sendResponse($response, false);
            }

            $result = $user->updateUser($data, "id=?", $id);
            // error_log("result: ".var_export($result, true));
            if ($result){
                $response['message'] = "User updated";
                Ajax::sendResponse($response);
            }
        } catch(\PDOException $e) {
            error_log("Error: ".$e->getMessage());
        }

    }



}
