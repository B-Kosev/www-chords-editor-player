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

    public static function isUsernameAvailable(string $username) : bool {

        $sql   = "SELECT * FROM `users` WHERE username = :username";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['username' => $username]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            return true;
        }

        return false;
    }

    public static function isEmailAvailable(string $email): bool {

        $sql   = "SELECT * FROM `users` WHERE email = :email";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['email' => $email]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            return true;
        }

        return false;
    }

    public static function checkCredentials(string $username, string $password): bool {

        $sql   = "SELECT * FROM `users` WHERE password = :password AND username = :username";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['password' => $password, 'username' => $username]);

        $userDbRows = $selectStatement->fetch();

        if (!$userDbRows) {
            return false;
        }

        return true;
    }


}