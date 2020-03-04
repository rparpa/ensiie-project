<?php
namespace Model\Entity\Pokemon;

class Pokemon{

  /**
  * @var string
  */
  private $abilities;

  /**
  * @var float
  */
  private $against_bug;

  /**
  * @var float
  */
  private $against_dark;

  /**
  * @var float
  */
  private $against_dragon;

  /**
  * @var float
  */
  private $against_electric;

  /**
  * @var float
  */
  private $against_fairy;

  /**
  * @var float
  */
  private $against_fight;

  /**
  * @var float
  */
  private $against_fire;

  /**
  * @var float
  */
  private $against_flying;

  /**
  * @var float
  */
  private $against_ghost;

  /**
  * @var float
  */
  private $against_grass;

  /**
  * @var float
  */
  private $against_ground;

  /**
  * @var float
  */
  private $against_ice;

  /**
  * @var float
  */
  private $against_normal;

  /**
  * @var float
  */
  private $against_poison;

  /**
  * @var float
  */
  private $against_psychic;

  /**
  * @var float
  */
  private $against_rock;

  /**
  * @var float
  */
  private $against_steel;

  /**
  * @var float
  */
  private $against_water;

  /**
  * @var int
  */
  private $attack;

  /**
  * @var float
  */
  private $base_egg_steps;

  /**
  * @var float
  */
  private $base_happiness;

  /**
  * @var int
  */
  private $base_total;

  /**
  * @var float
  */
  private $capture_rate;

  /**
  * @var string
  */
  private $classfication;

  /**
  * @var int
  */
  private $defense;

  /**
  *@var int
  */
  private $experience_growth;

  /**
  *@var float
  */
  private $height_m;

  /**
  *@var int
  */
  private $hp;

  /**
  * @var string
  */
  private $japanese_name;

  /**
  * @var string
  */
  private $english_name;

  /**
  * @var string
  */
  private $french_name;

  /**
  *@var float
  */
  private $percentage_male;

  /**
  *@var int
  */
  private $pokedex_number;

  /**
  *@var int
  */
  private $sp_attack;

  /**
  *@var int
  */
  private $sp_defense;

  /**
  *@var int
  */
  private $speed;

  /**
  * @var string
  */
  private $type1;

  /**
  * @var string
  */
  private $type2;

  /**
  *@var float
  */
  private $weight_kg;

  /**
  *@var int
  */
  private $generation;

  /**
  *@var int
  */
  private $is_legendary;

  /** * @return string*/ public function getAbilities(){ return $this->abilities; }
  /** * @return float*/ public function getAgainst_Bug(){ return $this->against_bug; }
  /** * @return float*/ public function getAgainst_Dark(){ return $this->against_dark; }
  /** * @return float*/ public function getAgainst_Dragon(){ return $this->against_dragon; }
  /** * @return float*/ public function getAgainst_Electric(){ return $this->against_electric; }
  /** * @return float*/ public function getAgainst_Fairy(){ return $this->against_fairy; }
  /** * @return float*/ public function getAgainst_Fight(){ return $this->against_fight; }
  /** * @return float*/ public function getAgainst_Fire(){ return $this->against_fire; }
  /** * @return float*/ public function getAgainst_Flying(){ return $this->against_flying; }
  /** * @return float*/ public function getAgainst_Ghost(){ return $this->against_ghost; }
  /** * @return float*/ public function getAgainst_Grass(){ return $this->against_grass; }
  /** * @return float*/ public function getAgainst_Ground(){ return $this->against_ground; }
  /** * @return float*/ public function getAgainst_Ice(){ return $this->against_ice; }
  /** * @return float*/ public function getAgainst_Normal(){ return $this->against_normal; }
  /** * @return float*/ public function getAgainst_Poison(){ return $this->against_poison; }
  /** * @return float*/ public function getAgainst_Psychic(){ return $this->against_psychic; }
  /** * @return float*/ public function getAgainst_Rock(){ return $this->against_rock; }
  /** * @return float*/ public function getAgainst_Steel(){ return $this->against_steel; }
  /** * @return float*/ public function getAgainst_Water(){ return $this->against_water; }
  /** * @return int*/ public function getAttack(){ return $this->attack; }
  /** * @return float*/ public function getBase_Egg_Steps(){ return $this->base_egg_steps; }
  /** * @return float*/ public function getBase_Happiness(){ return $this->base_happiness; }
  /** * @return int*/ public function getBase_Total(){ return $this->base_total; }
  /** * @return float*/ public function getCapture_Rate(){ return $this->capture_rate; }
  /** * @return string*/ public function getClassfication(){ return $this->classfication; }
  /** * @return int*/ public function getDefense(){ return $this->defense; }
  /** * @return int*/ public function getExperience_Growth(){ return $this->experience_growth; }
  /** * @return float*/ public function getHeight_M(){ return $this->height_m; }
  /** * @return int*/ public function getHp(){ return $this->hp; }
  /** * @return string*/ public function getJapanese_Name(){ return $this->japanese_name; }
  /** * @return string*/ public function getEnglish_Name(){ return $this->english_name; }
  /** * @return string*/ public function getFrench_Name(){ return $this->french_name; }
  /** * @return float*/ public function getPercentage_Male(){ return $this->percentage_male; }
  /** * @return int*/ public function getPokedex_Number(){ return $this->pokedex_number; }
  /** * @return int*/ public function getSp_Attack(){ return $this->sp_attack; }
  /** * @return int*/ public function getSp_Defense(){ return $this->sp_defense; }
  /** * @return int*/ public function getSpeed(){ return $this->speed; }
  /** * @return string*/ public function getType1(){ return $this->type1; }
  /** * @return string*/ public function getType2(){ return $this->type2; }
  /** * @return float*/ public function getWeight_Kg(){ return $this->weight_kg; }
  /** * @return int*/ public function getGeneration(){ return $this->generation; }
  /** * @return boolean*/ public function getIs_Legendary(){ return $this->is_legendary; }

/** * @param string $abilities * @return Pokemon */ public function setAbilities($abilities) { $this->abilities = $abilities; return $this; }
/** * @param float $against_bug * @return Pokemon */ public function setAgainst_Bug($against_bug) { $this->against_bug = $against_bug; return $this; }
/** * @param float $against_dark * @return Pokemon */ public function setAgainst_Dark($against_dark) { $this->against_dark = $against_dark; return $this; }
/** * @param float $against_dragon * @return Pokemon */ public function setAgainst_Dragon($against_dragon) { $this->against_dragon = $against_dragon; return $this; }
/** * @param float $against_electric * @return Pokemon */ public function setAgainst_Electric($against_electric) { $this->against_electric = $against_electric; return $this; }
/** * @param float $against_fairy * @return Pokemon */ public function setAgainst_Fairy($against_fairy) { $this->against_fairy = $against_fairy; return $this; }
/** * @param float $against_fight * @return Pokemon */ public function setAgainst_Fight($against_fight) { $this->against_fight = $against_fight; return $this; }
/** * @param float $against_fire * @return Pokemon */ public function setAgainst_Fire($against_fire) { $this->against_fire = $against_fire; return $this; }
/** * @param float $against_flying * @return Pokemon */ public function setAgainst_Flying($against_flying) { $this->against_flying = $against_flying; return $this; }
/** * @param float $against_ghost * @return Pokemon */ public function setAgainst_Ghost($against_ghost) { $this->against_ghost = $against_ghost; return $this; }
/** * @param float $against_grass * @return Pokemon */ public function setAgainst_Grass($against_grass) { $this->against_grass = $against_grass; return $this; }
/** * @param float $against_ground * @return Pokemon */ public function setAgainst_Ground($against_ground) { $this->against_ground = $against_ground; return $this; }
/** * @param float $against_ice * @return Pokemon */ public function setAgainst_Ice($against_ice) { $this->against_ice = $against_ice; return $this; }
/** * @param float $against_normal * @return Pokemon */ public function setAgainst_Normal($against_normal) { $this->against_normal = $against_normal; return $this; }
/** * @param float $against_poison * @return Pokemon */ public function setAgainst_Poison($against_poison) { $this->against_poison = $against_poison; return $this; }
/** * @param float $against_psychic * @return Pokemon */ public function setAgainst_Psychic($against_psychic) { $this->against_psychic = $against_psychic; return $this; }
/** * @param float $against_rock * @return Pokemon */ public function setAgainst_Rock($against_rock) { $this->against_rock = $against_rock; return $this; }
/** * @param float $against_steel * @return Pokemon */ public function setAgainst_Steel($against_steel) { $this->against_steel = $against_steel; return $this; }
/** * @param float $against_water * @return Pokemon */ public function setAgainst_Water($against_water) { $this->against_water = $against_water; return $this; }
/** * @param int $attack * @return Pokemon */ public function setAttack($attack) { $this->attack = $attack; return $this; }
/** * @param float $base_egg_steps * @return Pokemon */ public function setBase_Egg_Steps($base_egg_steps) { $this->base_egg_steps = $base_egg_steps; return $this; }
/** * @param float $base_happiness * @return Pokemon */ public function setBase_Happiness($base_happiness) { $this->base_happiness = $base_happiness; return $this; }
/** * @param int $base_total * @return Pokemon */ public function setBase_Total($base_total) { $this->base_total = $base_total; return $this; }
/** * @param float $capture_rate * @return Pokemon */ public function setCapture_Rate($capture_rate) { $this->capture_rate = $capture_rate; return $this; }
/** * @param string $classfication * @return Pokemon */ public function setClassfication($classfication) { $this->classfication = $classfication; return $this; }
/** * @param int $defense * @return Pokemon */ public function setDefense($defense) { $this->defense = $defense; return $this; }
/** * @param int $experience_growth * @return Pokemon */ public function setExperience_Growth($experience_growth) { $this->experience_growth = $experience_growth; return $this; }
/** * @param float $height_m * @return Pokemon */ public function setHeight_M($height_m) { $this->height_m = $height_m; return $this; }
/** * @param int $hp * @return Pokemon */ public function setHp($hp) { $this->hp = $hp; return $this; }
/** * @param string $japanese_name * @return Pokemon */ public function setJapanese_Name($japanese_name) { $this->japanese_name = $japanese_name; return $this; }
/** * @param string $english_name * @return Pokemon */ public function setEnglish_Name($english_name) { $this->english_name = $english_name; return $this; }
/** * @param string $french_name * @return Pokemon */ public function setFrench_Name($french_name) { $this->french_name = $french_name; return $this; }
/** * @param float $percentage_male * @return Pokemon */ public function setPercentage_Male($percentage_male) { $this->percentage_male = $percentage_male; return $this; }
/** * @param int $pokedex_number * @return Pokemon */ public function setPokedex_Number($pokedex_number) { $this->pokedex_number = $pokedex_number; return $this; }
/** * @param int $sp_attack * @return Pokemon */ public function setSp_Attack($sp_attack) { $this->sp_attack = $sp_attack; return $this; }
/** * @param int $sp_defense * @return Pokemon */ public function setSp_Defense($sp_defense) { $this->sp_defense = $sp_defense; return $this; }
/** * @param int $speed * @return Pokemon */ public function setSpeed($speed) { $this->speed = $speed; return $this; }
/** * @param string $type1 * @return Pokemon */ public function setType1($type1) { $this->type1 = $type1; return $this; }
/** * @param string $type2 * @return Pokemon */ public function setType2($type2) { $this->type2 = $type2; return $this; }
/** * @param float $weight_kg * @return Pokemon */ public function setWeight_Kg($weight_kg) { $this->weight_kg = $weight_kg; return $this; }
/** * @param int $generation * @return Pokemon */ public function setGeneration($generation) { $this->generation = $generation; return $this; }
/** * @param int $is_legendary * @return Pokemon */ public function setIs_Legendary($is_legendary) { $this->is_legendary = $is_legendary; return $this; }

}
