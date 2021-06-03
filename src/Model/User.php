<?php

namespace Model;


class User{

    private string $username;
    private string $mail;
    private bool $admin;
    
    
    public function getUsername(): string{
        return $this->username;
    }

    public function getMail(): string{
        return $this->mail;
    }

    public function isAdmin(): bool{
        return $this->admin;
    }

    public static function verifyPassword($username, $password, $pdo){
        $sql = 'SELECT passwd FROM public.User WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        
        $rows = $stmt->rowCount();
        if($rows == 1){
            $result = $stmt->fetch();
            return password_verify($password, $result['passwd']);
        }
        elseif($rows > 1){
            $msg = "More than one user named : ".$username." in database";
            file_put_contents('php://stderr', print_r($msg."\n", TRUE));
        }
        return false;
    }

    public static function createUser($username, $email, $password, $pdo){
        $cryptedPwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $date = date('Y-m-d', time());
        
        $sql = 'INSERT INTO public.User (USERNAME, EMAIL, PASSWD, CREATION_DATE, VALIDATE) VALUES (?, ?, ?, ?, FALSE)';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username); $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $cryptedPwd); $stmt->bindParam(4, $date);
        $stmt->execute();

        $result = $stmt->rowCount();
        return $result == 1;
    }

    public static function emailExist($email, $pdo){
        $sql = 'SELECT * FROM public.User WHERE email = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function checkUsername($username, $pdo){
        $sql = 'SELECT * FROM public.User WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function userIsAdmin($username, $pdo){
        $sql = 'SELECT * FROM public.Admin WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }
}
?>