<?php

use Db\Connection;
use User\UserHydrator;
use User\UserRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';


$userRepository =
    new UserRepository(Connection::get(), new UserHydrator());

$id =  !empty($_POST['id']) ? $_POST['id'] : null;
$username =  !empty($_POST['username']) ? $_POST['username'] : null;
$surname =  !empty($_POST['surname']) ? $_POST['surname'] : null;
$name =  !empty($_POST['name']) ? $_POST['name'] : null;
$mail =  !empty($_POST['mail']) ? $_POST['mail'] : null;
$password =  !empty($_POST['password']) ? $_POST['password'] : null;
$passwordcheck =  !empty($_POST['passwordcheck']) ? $_POST['passwordcheck'] : null;

$viewData = [];

function checkFormData(UserRepository $userRepository, $id, $username, $surname, $name ,$mail, $password, $passwordcheck)
{
    $errorMessage = [];
    if($id) {
        $user = $userRepository->findOneById($id);
        if($user->getId()!==$userRepository->findOneByUsername($username)->getId()){
            $errorMessage['surnameAlreadyExist'] = "The username you tried to update already exists";
        }
        if($user->getId()!=$userRepository->findOneByMail($mail)->getId()){
            $errorMessage['mailAlreadyExist'] = "The mail you tried to register already exists";
        }
    }
    else{
        if(null!=$userRepository->findOneByUsername($username)) {
            $errorMessage['userAlreadyExist'] = "The user you tried to register already exists";
        }
        if(null!=$userRepository->findOneByMail($mail)) {
            $errorMessage['mailAlreadyExist'] = "The mail you tried to register already exists";
        }
    }
    if(null === $surname) {
        $errorMessage['surnameEmpty'] = "The surname can't be empty";
    }
    if(null === $name) {
        $errorMessage['nameEmpty'] = "The name can't be empty";
    }
    if($password !== $passwordcheck) {
        $errorMessage['passwordDoesNotMatch'] = "The given passwords do not match";
    }

    return $errorMessage;
}

if (null !== $mail && null !== $password) {
    $viewData = checkFormData($userRepository, $id, $username, $surname, $name ,$mail, $password, $passwordcheck);
    if (empty($viewData)) {
        if($id){
            $userRepository->update($id, $username, $surname, $name, $mail, password_hash($password, PASSWORD_DEFAULT));
        }
        else {
            $userRepository->insert($username, $surname, $name, $mail, password_hash($password, PASSWORD_DEFAULT), new DateTimeImmutable("now"));
        }
        header('Location: index.php');
    }
    loadView('user', $viewData);
}

