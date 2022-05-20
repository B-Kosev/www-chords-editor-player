<?php

    require_once '../model/Bootstrap.php';
    Bootstrap::initApp();

    switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        // $username = $_GET['username'];
        // $password = $_GET['password'];

        // $conn = new mysqli("localhost","root","","chordsplayereditor");

        // if($conn->connect_error){
        //     die("Connection Failed : ".$conn->connect_error);
        // }else{
        // }

    }
    case 'POST': {
        if(isset($_POST['register'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conPassword = $_POST['confirm_password'];

            $success = true;
            $errors = array();

            if(empty($email)){
                $success = false;
                $errors += ["email" => "Email field is required."];
            }

            if(empty($username)){
                $success = false;
                $errors += ["username" => "Username field is required."];
            }

            if(empty($password)){
                $success = false;
                $errors += ["password" => "Pasword field is required."];
            }

            if(empty($conPassword)){
                $success = false;
                $errors += ["conPassword" => "Confirm password field is required."];
            }

            if(strlen($username) > 0 and strlen($username) < 6 or strlen($username) > 30){
                $success = false;
                $errors += ["username" => "Username must be between 6 and 30 symbols."];
            }

            if(strlen($password) > 0 and strlen($password) < 8 ){
                $success = false;
                $errors += ["password" => "Password must be at least 8 symbols."];
            }

            if($password !== $conPassword){
                $success = false;
                $errors += ["password match" => "Passwords doesn't match."];
            }

            $usernameResponse = UserService::isUsernameFree($username);

            if($usernameResponse == false ){
                $success = false;
                $errors += ["existing username" => "There is already a user with this username."];
            }

            $emailResponse = UserService::isEmailFree($email);

            if($emailResponse == false ){
                $success = false;
                $errors += ["existing email" => "There is already a user with this email."];
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
                    header("Location: /project/www-chords-editor-player/resources/index.html");
                }
            }
        }
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

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
                $errors += ["credentials" => "Bad credentials."];
            }

            if(!$success){
                echo json_encode($errors, JSON_UNESCAPED_UNICODE);
            }else{
                echo "success";
            }
        }
    }
}
