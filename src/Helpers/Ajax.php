<?php
namespace src\Helpers;

class Ajax {

    private $message;
    private $html;

    public static function is()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest")){
            return true;
        } else {
            echo "This request is not allowed";
            exit;
        }
    }

    public static function sendResponse($data=array(), $success=true){

        if (!$success) {
            echo json_encode(array("success" => false, "message" => "Something went wrong"));
            return;
        }

        // if (is_array($data) && !empty($data)){
        $data["success"] = $success;
        echo json_encode($data);
        // }

    }



}
