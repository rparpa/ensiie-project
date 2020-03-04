<?php
include_once '../src/Bootstrap.php';

$datas = $_POST;
//var_dump($_POST);die;
$action = !empty($datas['action']) ? $datas['action'] : null;
$userRepository = new Model\Entity\User\UserRepository(\Db\Connection::get());

if($action == "loginAction"){
  $login = !empty($datas['login']) ? $datas['login'] : null;
  $pwd = !empty($datas['pwd']) ? $datas['pwd'] : null;
  if($login != null && $pwd != null){
    //Si la combinnaison login mdp existe renvoyer sur l'index avec la session enregistrer sinon retrourner sur la page avec un code erreur
    if($userRepository->userExist($login,$pwd)){
      $_SESSION['user_login']=$login;
      header('Location: pokedex.php');
    }else{
      header('Location: pokedex.php?erreur=1');
    }
  }else{
    header('Location: pokedex.php?erreur=1');
  }
}elseif ($action == "inscriptionAction") {

  $login = !empty($datas['login']) ? $datas['login'] : null;
  $pwd = !empty($datas['pwd']) ? $datas['pwd'] : null;

  if($login != null && $pwd != null){
      if($userRepository->loginExist($login)){
        header('Location: pokedex.php?erreur=2');
      }else{
        $success = $userRepository->inscriptionUser($login,$pwd);
        if($success){
          header('Location: pokedex.php?success=1');
        }else{
          header('Location: pokedex.php?erreur=1');
        }
      }
  }else{
    header('Location: pokedex.php?erreur=1');
  }

}else{
  header('Location: pokedex.php');
}


?>
