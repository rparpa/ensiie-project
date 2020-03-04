<?php
namespace Model\Entity\Pokemon;
use PDO;


class PokemonRepository{

  /**
   * @var \PDO
   */
  private PDO $connection;

  public function hydrate($row = array()){
     if (empty($row)){
       return null;
     }
     $pokemon = new Pokemon();
     $pokemon
         ->setAbilities($row->abilities)
         ->setAgainst_Bug($row->against_bug)
         ->setAgainst_Dark($row->against_dark)
         ->setAgainst_Dragon($row->against_dragon)
         ->setAgainst_Electric($row->against_electric)
         ->setAgainst_Fairy($row->against_fairy)
         ->setAgainst_Fight($row->against_fight)
         ->setAgainst_Fire($row->against_fire)
         ->setAgainst_Flying($row->against_flying)
         ->setAgainst_Ghost($row->against_ghost)
         ->setAgainst_Grass($row->against_grass)
         ->setAgainst_Ground($row->against_ground)
         ->setAgainst_Ice($row->against_ice)
         ->setAgainst_Normal($row->against_normal)
         ->setAgainst_Poison($row->against_poison)
         ->setAgainst_Psychic($row->against_psychic)
         ->setAgainst_Rock($row->against_rock)
         ->setAgainst_Steel($row->against_steel)
         ->setAgainst_Water($row->against_water)
         ->setAttack($row->attack)
         ->setBase_Egg_Steps($row->base_egg_steps)
         ->setBase_Happiness($row->base_happiness)
         ->setBase_Total($row->base_total)
         ->setCapture_Rate($row->capture_rate)
         ->setClassfication($row->classfication)
         ->setDefense($row->defense)
         ->setExperience_Growth($row->experience_growth)
         ->setHeight_M($row->height_m)
         ->setHp($row->hp)
         ->setJapanese_Name($row->japanese_name)
         ->setEnglish_Name($row->english_name)
         ->setFrench_Name($row->french_name)
         ->setPercentage_Male($row->percentage_male)
         ->setPokedex_Number($row->pokedex_number)
         ->setSp_Attack($row->sp_attack)
         ->setSp_Defense($row->sp_defense)
         ->setSpeed($row->speed)
         ->setType1($row->type1)
         ->setType2($row->type2)
         ->setWeight_Kg($row->weight_kg)
         ->setGeneration($row->generation)
         ->setIs_Legendary($row->is_legendary);
    return $pokemon;
   }

  /**
   * UserRepository constructor.
   * @param PDO $connection
   */
  public function __construct(PDO $connection){
      $this->connection = $connection;
  }

  public function search($nom, $type1, $type2,$is_legendary, $start,$length,$order_column,$order_direction){
      $txtrequete = 'Select * from "pokemon" ';
      $count= 0;
      if($nom != null){
        $txtrequete .="where french_name ILIKE '%".$nom."%' ";
        $count++;
      }
      if($is_legendary == 1 && $count < 1){
        $txtrequete .=" where is_legendary = ".$is_legendary." ";
        $count++;
      }elseif($is_legendary == 1){
        $txtrequete .=" and is_legendary = ".$is_legendary." ";
      }
      if($type1 != null && $type2 != null && $count < 1){
        $txtrequete .=" where (type1 LIKE '%".$type1."%' and type2 LIKE '".$type2."') or (type1 LIKE '%".$type2."%' and type2 LIKE '".$type1."') ";
        $count++;
      }elseif($type1 != null && $type2 != null) {
        $txtrequete .=" and (type1 LIKE '".$type1."' and type2 LIKE '".$type1."') or (type1 LIKE '%".$type2."%' and type2 LIKE '".$type1."') ";
      }else{
        if($type1 != null && $count < 1){
          $txtrequete .=" where ( type1 LIKE '%".$type1."%' or type2 LIKE '".$type1."' )";
          $count++;
        }elseif($type1 != null) {
          $txtrequete .=" and ( type1 LIKE '".$type1."' or type2 LIKE '".$type1."' )";
        }
        if($type2 != null  && $count < 1){
          $txtrequete .=" where ( type2 LIKE '".$type2."' or type1 LIKE '".$type2."' )";
          $count++;
        }elseif($type2 != null ) {
          $txtrequete .=" and ( type2 LIKE '".$type2."' or type1 LIKE '".$type2."' )";
        }
      }

      //Switch case pour l'order by les numero corresponde a l'odre des colonne dans le datatable de la vue
      switch ($order_column) {
        case 0 :
          $txtrequete .=" ORDER BY pokedex_number  " . $order_direction;
          break;
        case 1:
          $txtrequete .=" ORDER BY french_name  " . $order_direction;
          break;
        case 2:
          $txtrequete .=" ORDER BY type1  " . $order_direction;
          break;
        case 3:
          $txtrequete .=" ORDER BY type2  " . $order_direction;
          break;
      }

      $stmt = $this->connection->prepare($txtrequete);

      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
      $pokemons = [];
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

  public function findById($id){
      $txtrequete = "Select * from pokemon where  pokedex_number = ".$id;
      $stmt = $this->connection->prepare($txtrequete);
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_OBJ);
      //return $row[0];
      return $this->hydrate($row[0]);
  }

}
