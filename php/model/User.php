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
}