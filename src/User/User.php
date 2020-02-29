<?php
namespace User;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Boolean;

class User
{
    private int $id;

    private string $username;

    private string $surname;

    private string $name;

    private string $mail;

    private string $password;

    private DateTimeInterface $creationdate;

    private bool $isadmin;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->isadmin = false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
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
     * @return User
     */
    public function setMail(string $mail): User
    {
        $this->mail = $mail;
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
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreationdate(): DateTimeInterface
    {
        return $this->creationdate;
    }

    /**
     * @param DateTimeInterface $creationdate
     * @return User
     */
    public function setCreationdate(DateTimeInterface $creationdate): User
    {
        $this->creationdate = $creationdate;
        return $this;
    }

    /**
     * @return array
     */
    public function getTask(): array
    {
        return $this->task;
    }

    /**
     * @param array $task
     * @return User
     */
    public function setTask(array $task): User
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return array
     */
    public function getMeetings(): array
    {
        return $this->meetings;
    }

    /**
     * @param array $meetings
     * @return User
     */
    public function setMeetings(array $meetings): User
    {
        $this->meetings = $meetings;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsadmin(): bool
    {
        return $this->isadmin;
    }

    /**
     * @param bool $isadmin
     * @return User
     */
    public function setIsadmin(bool $isadmin): User
    {
        $this->isadmin = $isadmin;
        return $this;
    }


}

