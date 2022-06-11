<?php

    session_start();

    require_once '../model/Bootstrap.php';
    Bootstrap::initApp();

    switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        $logged = isset($_SESSION['username']);
        echo json_encode(["logged" => $logged, "session" => $_SESSION]);
        break;
    }
    case 'POST': {
        $requestBody = json_decode(file_get_contents("php://input"), true);

        if(isset($requestBody['register'])){
            $user = new User(0, $requestBody['username'], $requestBody['email'], $requestBody['password']);
            
            UserService::register($user, $requestBody['confirm_password']);
        }
        if(isset($requestBody['login'])){
            $response = UserService::login($requestBody['username'], $requestBody['password']);

            if($response !== "error"){
                $_SESSION['username'] = $response;
            }
        }
        break;
    }
    case 'DELETE': {
        session_destroy();
        echo json_encode(["success" => true]);
    }
}
