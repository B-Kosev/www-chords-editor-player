<?php

    session_start();

    require_once '../model/Bootstrap.php';
    Bootstrap::initApp();

    switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        $logged = isset($_SESSION['used_id']);
        break;
    }
    case 'POST': {
        $requestBody = json_decode(file_get_contents("php://input"), true);

        if(isset($requestBody['register'])){
            $email = $requestBody['email'];
            $username = $requestBody['username'];
            $password = $requestBody['password'];
            $conPassword = $requestBody['confirm_password'];
            $emailErrorMsg = '';
            $usernameErrorMsg = '';
            $passwordErrorMsg = '';
            $conPasswordErrorMsg  = '';

            $success = true;
            $errors = array();

            if(empty($email)){
                $success = false;
                $emailErrorMsg = "Email field is required.";
                $errors += ["email" => $emailErrorMsg];
            }

            if(empty($username)){
                $success = false;
                $usernameErrorMsg = "Username field is required.";
                $errors += ["username" => $usernameErrorMsg];
            }

            if(empty($password)){
                $success = false;
                $passwordErrorMsg = "Pasword field is required.";
                $errors += ["password" => $passwordErrorMsg];
            }

            if(empty($conPassword)){
                $success = false;
                $conPasswordErrorMsg = "Confirm password field is required.";
                $errors += ["conPassword" => $conPasswordErrorMsg];
            }

            if(strlen($username) > 0 and strlen($username) < 6 or strlen($username) > 30){
                $success = false;
                $username = "Username must be between 6 and 30 symbols.";
                $errors += ["username" => $username];
            }

            if(strlen($password) > 0 and strlen($password) < 8 ){
                $success = false;
                $passwordErrorMsg = "Password must be at least 8 symbols.";
                $errors += ["password" => $passwordErrorMsg];
            }

            if($password !== $conPassword){
                $success = false;
                $conPasswordErrorMsg = "Passwords doesn't match.";
                $errors += ["conPassword" => $conPasswordErrorMsg];
            }

            $usernameResponse = UserService::isUsernameAvailable($username);

            if($usernameResponse == false ){
                $success = false;
                $usernameErrorMsg = "There is already registered user with this username.";
                $errors += ["username" => $usernameErrorMsg];
            }

            $emailResponse = UserService::isEmailAvailable($email);

            if($emailResponse == false ){
                $success = false;
                $emailErrorMsg = "There is already registered user with this email.";
                $errors += ["email" => $emailErrorMsg];
            }

            if(!$success){
                echo json_encode($errors, JSON_UNESCAPED_UNICODE);
                // header("Location: /project/www-chords-editor-player/resources/register.html");
            }else{
                $conn = new mysqli("localhost","root","","chordsplayereditor");
                
                if($conn->connect_error){
                    die("Connection Failed : ".$conn->connect_error);
                }else{
                    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $username, $password, $email);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                    echo json_encode(["success" => true]);
                    header("Location: /project/www-chords-editor-player/resources/index.html");
                }
            }
        }
        if(isset($requestBody['login'])){

            $username = $requestBody['username'];
            $password = $requestBody['password'];

            $success = true;
            $errors = array();

            if(empty($username)){
                $success = false;
                $errors += ["username" => "Username field is required."];
            }

            if(empty($password)){
                $success = false;
                $errors += ["password" => "Pasword field is required."];
            }

            $response = UserService::checkCredentials($username, $password);

            if(!$response){
                $success = false;
                $errors += ["credentials" => "Wrong combination of username and password."];
            }

            if(!$success){
                echo json_encode($errors, JSON_UNESCAPED_UNICODE);
            }else{
                echo "success";
            }
        }
    }
}
