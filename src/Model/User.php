<?php

namespace Model;


class User{

    private string $username;
    private string $mail;
    private string $password;
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

    public static function test(){
        echo "SALU LE MOND3";
        return "SALUZ";
    }

    public static function verifyPassword($username, $password, $pdo){
        file_put_contents('php://stderr', print_r("HELP1 \n", TRUE));

        $sql = 'SELECT passwd FROM public.User WHERE username = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        
        $rows = $stmt->rowCount();
        file_put_contents('php://stderr', print_r($rows."\n", TRUE));
        if($rows == 1){
            $result = $stmt->fetch();
            file_put_contents('php://stderr', print_r("I exis\n", TRUE));
            return password_verify($password, $result['passwd']);
        }
        elseif($rows > 1){
            $msg = "More than one user named : ".$username." in database";
            file_put_contents('php://stderr', print_r($msg."\n", TRUE));
        }
        return false;
    }
}
?>