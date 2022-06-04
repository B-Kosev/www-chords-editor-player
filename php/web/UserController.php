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

            $hashedPassword = sha1($password);

            if(!$success){
                $errors += ["success" => $success];
                echo json_encode($errors, JSON_UNESCAPED_UNICODE);
            }else{
                // $conn = new mysqli("localhost","root","","chordsplayereditor");
                $conn = (new Database())->getConnection();

                // if($conn->connect_error){
                //     die("Connection Failed : ".$conn->connect_error);
                // }else{
                    // $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                    // $stmt->bind_param("sss", $username, $hashedPassword, $email);
                    // $stmt->execute();
                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                    // $stmt->close();
                    // $conn->close();

                    echo json_encode(["success" => $success]);
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

            $hashedPassword = sha1($password);

            $response = UserService::checkCredentials($username, $hashedPassword);

            if(!$response){
                $success = false;
                $errors += ["credentials" => "Wrong combination of username and password."];
            }

            if(!$success){
                echo json_encode($errors, JSON_UNESCAPED_UNICODE);
            }else{
                // $_SESSION['id'] = UserService::getUserByUsername().getId();
                $_SESSION['username'] = $username;

                echo json_encode(["success" => true]);
            }
        }

        //TO DO: checking visibility of pages 
        if(isset($requestBody['page'])){
            $page = $requestBody['page'];
            if($page == "login.php" && $_SESSION['username']){
                header("Location: ../../resources/index.php");
                echo json_encode(["success" => true]);
            }
        }
        break;
    }
    case 'DELETE': {
        session_destroy();
        echo json_encode(["success" => true]);
    }
}
