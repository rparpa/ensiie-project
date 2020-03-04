<?php
include_once '../src/Bootstrap.php';
//var_dump($_SESSION);die;

$datas = $_POST;
$action = !empty($datas['action']) ? $datas['action'] : null;

$userRepository = new Model\Entity\User\UserRepository(\Db\Connection::get());
$pokemonRepository = new Model\Entity\Pokemon\PokemonRepository(\Db\Connection::get());
$favoriteRepository = new Model\Entity\Favorie\FavorieRepository(\Db\Connection::get());


if($action == 'search'){
  $nom =  !empty($datas['name']) ? $datas['name'] : null;
  $type1 =  !empty($datas['type1']) ? $datas['type1'] : null;
  $type2 =  !empty($datas['type2']) ? $datas['type2'] : null;
  $is_legendary = 0;
  if($datas['legendary'] == "true"){
    $is_legendary = 1;
  }

  $length=$datas["length"];
  $start=$datas["start"];
  $length+=$start; // La taille plus le debut
  $order_column=$datas["order"][0]["column"];
  $order_direction=$datas["order"][0]["dir"];

  $pokemons = $pokemonRepository->search($nom, $type1, $type2,$is_legendary, $start, $length ,$order_column,$order_direction);
  $return = array(
    "draw" => $datas["draw"],
    "data" => $pokemons,
    "recordsTotal" => count($pokemons),
    "recordsFiltered" => count($pokemons)
  );
  $return = json_encode($return);
  echo $return;
}elseif($action == 'addFav') {
  $user =  !empty($datas['id_user']) ? $datas['id_user'] : null;
  $id_pokemon =  !empty($datas['pokemon_id']) ? $datas['pokemon_id'] : null;
  if($user != null && $id_pokemon != null){
      $favoriteRepository->addFavorie($id_pokemon, $user);
  }
  $resultat = '<button type="submit" class="btn btn-info btn-lg" onclick="delFav();" id="btnDel"><span class="glyphicon glyphicon-star" style="color:red;"></span></button>';
  echo $resultat;
}elseif($action == 'delFav'){
  $user =  !empty($datas['id_user']) ? $datas['id_user'] : null;
  $id_pokemon =  !empty($datas['pokemon_id']) ? $datas['pokemon_id'] : null;
  if($user != null && $id_pokemon != null){
      $favoriteRepository->delFavorie($id_pokemon, $user);
  }

  $resultat = '<button type="submit" class="btn btn-info btn-lg" onclick="addFav();" id="btnAdd"><span class="glyphicon glyphicon-star" ></span></button>';
  echo $resultat;

}elseif($action == 'searchFav'){
  $user =  !empty($datas['id_user']) ? $datas['id_user'] : null;

  $length=$datas["length"];
  $start=$datas["start"];
  $length+=$start; // La taille plus le debut
  $order_column=$datas["order"][0]["column"];
  $order_direction=$datas["order"][0]["dir"];

  $pokemons = $favoriteRepository->search($user, $start, $length ,$order_column,$order_direction);
  $return = array(
    "draw" => $datas["draw"],
    "data" => $pokemons,
    "recordsTotal" => count($pokemons),
    "recordsFiltered" => count($pokemons)
  );
  $return = json_encode($return);
  echo $return;
}else{
  header('Location: pokedex.php');
}
//Si on veut aller sur le controlleur sans action

?>
