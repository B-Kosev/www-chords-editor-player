<?php

Class User{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct(string $id, string $username, string $email, string $password){
        this->id = $id;
        this->username = $username;
        this->email = $email;
        this->password = $password;
    }

    public function getId(): int {
        return this->id;
    }

    public function getUsername(): int {
        return this->username;
    }

    public function getEmail(): int {
        return this->email;
    }

    public function getPassword(): int {
        return this->password;
    }

    public static function createFromForm(array $assocUser): User{
        return new User($assocUser['id'], 
            $assocUser['username'], 
            $assocUser['email'], 
            $assocUser['password']);
    }
}