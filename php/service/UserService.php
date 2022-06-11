<?php

class UserService {

    public static function getUserById(string $userId): User {

        $sql   = "SELECT * FROM `users` WHERE id = :user_id";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['user_id' => $userId]);


        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            throw new NotFoundException("User with id $userId not found.");
        }

        return User::createFromForm($userDbRows);
    }

    public static function getUserByUsername(string $username): User {

        $sql   = "SELECT * FROM `users` WHERE username = :username";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['username' => $username]);


        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            throw new NotFoundException("User with username $username not found.");
        }

        return User::createFromForm($userDbRows);
    }

    public static function getUserByEmail(string $email): User {

        $sql   = "SELECT * FROM `users` WHERE email = :email";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['email' => $email]);


        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            throw new NotFoundException("User with email $email not found.");
        }

        return User::createFromForm($userDbRows);
    }

    public static function register(User $user, string $conPassword): void{
        $errors = UserService::registerValidation($user, $conPassword);

        if(sizeof($errors) > 0){
            $errors += ["success" => false];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        }else{
            $hashedPassword = sha1($user->getPassword());

            $conn = (new Database())->getConnection();
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            $stmt->execute([':username' => $user->getUsername(), ':password' => $hashedPassword, ':email' => $user->getEmail()]);
            
            echo json_encode(["success" => true]);
        }
    }

    public static function login(string $username, string $password): string{
        
        $hashedPassword = sha1($password);
        $errors = UserService::checkCredentials($username, $hashedPassword);

        if(sizeof($errors) > 0){
            $errors += ["success" => false];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
            return "error";
        }else{
            echo json_encode(["success" => true]);
            return $username;
        }
    }

    private static function registerValidation(User $user, string $conPassword): array{
        $errors = array();

        if($user->getEmail() == null){
            $errors += ["email" => "Email field is required."];
        }

        if($user->getUsername() == null){
            $errors += ["username" => "Username field is required."];
        }

        if($user->getPassword() == null){
            $errors += ["password" => "Pasword field is required."];
        }

        if(empty($conPassword)){
            $errors += ["conPassword" => "Confirm password field is required."];
        }

        if(strlen($user->getUsername()) > 0 and strlen($user->getUsername()) < 6 or strlen($user->getUsername()) > 30){
            $errors += ["username" => "Username must be between 6 and 30 symbols."];
        }

        if(strlen($user->getPassword()) > 0 and strlen($user->getPassword()) < 8 ){
            $errors += ["password" => "Password must be at least 8 symbols."];
        }

        if($user->getPassword() !== $conPassword){
            $errors += ["conPassword" => "Passwords doesn't match."];
        }

        $usernameResponse = UserService::isUsernameAvailable($user->getUsername());

        if(!$usernameResponse){
            $errors += ["username" => "There is already registered user with this username."];
        }

        $emailResponse = UserService::isEmailAvailable($user->getEmail());

        if(!$emailResponse){
            $errors += ["email" => "There is already registered user with this email."];
        }

        return $errors;
    }
    
    private static function checkCredentials(string $username, string $password): array {
        $errors = array();
        
        if(strlen($username) == 0){
            $errors += ["username" => "Username field is required."];
        }

        if(strlen($password) == 0){
            $errors += ["password" => "Pasword field is required."];
        }

        $sql   = "SELECT * FROM `users` WHERE password = :password AND username = :username";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['password' => $password, 'username' => $username]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            $errors += ["credentials" => "Wrong combination of username and password."];
        }

        return $errors;
    }

    private static function isUsernameAvailable(string $username) : bool {

        $sql   = "SELECT * FROM `users` WHERE username = :username";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['username' => $username]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            return true;
        }

        return false;
    }

    private static function isEmailAvailable(string $email): bool {

        $sql   = "SELECT * FROM `users` WHERE email = :email";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['email' => $email]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            return true;
        }

        return false;
    }
    
}