<?php

namespace models;

use JsonSerializable;

class User implements JsonSerializable
{

    protected string $mail;
    protected string $firstname;
    protected string $lastname;
    protected string $pseudo;
    protected string $password;
    protected string $picture;
    protected int $zipcode;
    protected string $street;
    protected string $city;
    protected bool $is_super_user;
    protected bool $is_banned;


    function __construct($mail, $firstname, $lastname, $pseudo, $password, $picture,
                         $zipcode, $street, $city, $is_super_user, $is_banned)
    {

        $this->mail = $mail;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->picture = $picture;
        $this->zipcode = $zipcode;
        $this->street = $street;
        $this->city = $city;
        $this->is_super_user = $is_super_user;
        $this->is_banned = $is_banned;

    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return int
     */
    public function getZipcode(): int
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode(int $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return bool
     */
    public function getIsSuperUser(): bool
    {
        return $this->is_super_user;
    }

    /**
     * @param bool $is_super_user
     */
    public function setIsSuperUser(bool $is_super_user): void
    {
        $this->is_super_user = $is_super_user;
    }

    /**
     * @return bool
     */
    public function getIsBanned(): bool
    {
        return $this->is_banned;
    }

    /**
     * @param bool $is_banned
     */
    public function setIsBanned(bool $is_banned): void
    {
        $this->is_banned = $is_banned;
    }


    public function jsonSerialize()
    {
        return [
            'email' => $this->mail,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'pseudo' => $this->pseudo,
            'password' => $this->password,
            'picture' => $this->picture,
            'zipcode' => $this->zipcode,
            'street' => $this->street,
            'city' => $this->city,
            'is_super_user' => $this->is_super_user,
            'is_banned' => $this->is_banned
        ];
    }
}

