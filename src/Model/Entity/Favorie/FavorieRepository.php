<?php
namespace Model\Entity\Favorie;
use PDO;

class FavorieRepository{

  /**
   * @var \PDO
   */
  private PDO $connection;

  /**
   * UserRepository constructor.
   * @param PDO $connection
   */
  public function __construct(PDO $connection){
      $this->connection = $connection;
  }

  public function addFavorie($id_pokemon, $user){
    $stmt = $this->connection->prepare(
      'INSERT INTO "favorie" (id_user, id_pokemon) VALUES (:id_user, :id_pokemon)'
    );
    $stmt->bindValue(':id_user', $user, \PDO::PARAM_STR);
    $stmt->bindValue(':id_pokemon', $id_pokemon, \PDO::PARAM_STR);
    $stmt->execute();
    return 0;
  }

  public function delFavorie($id_pokemon, $user){
    $stmt = $this->connection->prepare(
      'DELETE FROM "favorie"  where id_user = :id_user and id_pokemon = :id_pokemon'
    );
    $stmt->bindValue(':id_user', $user, \PDO::PARAM_STR);
    $stmt->bindValue(':id_pokemon', $id_pokemon, \PDO::PARAM_STR);
    $stmt->execute();
    return 0;
  }

  public function isFavorie($id_pokemon, $user){
    $stmt = $this->connection->prepare(
      'Select * from "favorie" where id_pokemon = :id_pokemon and id_user = :id_user'
    );
    $stmt->bindValue(':id_pokemon', $id_pokemon, \PDO::PARAM_STR);
    $stmt->bindValue(':id_user', $user, \PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    return !empty($rows);
  }

  public function search($user, $start, $length ,$order_column,$order_direction){
    $stmt = $this->connection->prepare(
      'SELECT * FROM favorie LEFT JOIN  pokemon ON favorie.id_pokemon = pokemon.pokedex_number where favorie.id_user = :id_user'
    );
    $stmt->bindValue(':id_user', $user, \PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    $pokemons = [];
    //var_dump($rows);die;
    $type_2 ="";
    foreach ($rows as $row) {
        if($row->type2 !=""){
          $type_2 ='<img src="/img/'.$row->type2.'.png">';
        }else{
          $type_2 ="";
        }
        $pokemon = array(
          'pokedex_number' => '<img src="/img/'.$row->pokedex_number.'.png">',
          'french_name' => '<a href="pokemon.php?id='.$row->pokedex_number.'">'.$row->french_name.'</a>',
          'type1' =>'<img src="/img/'.$row->type1.'.png">',
          'type2' => $type_2
        );
        $pokemons[] = $pokemon;
    }
    return $pokemons;
  }
}
