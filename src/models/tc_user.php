<?php

namespace models;

class tc_user {

    protected string $mail;
    protected string $firstname;
    protected string $lastname;
    protected string $pseudo;
    protected string $picture;
    protected int $zipcode;
    protected string $street;
    protected string $city;
    protected bool $is_super_user;
    protected bool $is_banned;

    function __construct($mail, $firstname, $lastname, $pseudo, $picture,
                         $zipcode, $street, $city, $is_super_user, $is_banned) {

        $this->mail = $mail;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = $pseudo;
        $this->picture = $picture;
        $this->zipcode = $zipcode;
        $this->street = $street;
        $this->city = $city;
        $this->is_super_user = $is_super_user;
        $this->is_banned = $is_banned;

    }

}

