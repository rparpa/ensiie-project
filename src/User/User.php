<?php
namespace User;

use DateTimeInterface;
use Exception;

/**
 * Class User
 * @package User
 */
class User
{
    /**
     * @var int
     */
    private ?int $id = null;

    /**
     * @var string
     */
    private string $pseudo;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $firstname;

    /**
     * @var string
     */
    private string $lastname;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $birthday;

    /**
     * @var string
     */
    private string $mail;

    /**
     * @var bool
     */
    private ?bool $isValidator = true;

    /**
     * @return bool
     */
    public function isValidator()
    {
        return $this->isValidator;
    }


    /**
     * @param bool $isValidator
     * @return $this
     */
    public function setIsValidator($isValidator)
    {
        $this->isValidator = $isValidator;
        return $this;
    }



    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param $pseudo
     * @return $this
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBirthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @param DateTimeInterface $birthday
     * @return User
     */
    public function setBirthday(DateTimeInterface $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getAge(): int
    {
        $now = new \DateTime();

        if ($now < $this->getBirthday()) {
            throw new \OutOfRangeException('Birthday in the future');
        }

        return $now->diff($this->getBirthday())->y;
    }
}

