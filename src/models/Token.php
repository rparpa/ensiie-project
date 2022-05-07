<?php

namespace models;

class Token
{

    private string $token;

    private string $user_email;

    function __construct($token, $user_email)
    {
        $this->token = $token;
        $this->user_email = $user_email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUserMail(): string
    {
        return $this->user_email;
    }
}