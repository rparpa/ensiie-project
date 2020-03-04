<?php
namespace Model\Entity\Favorie;

class Favorie{



  /**
   * @var int
   */
  private $id_pokemon;

  /**
   * @var string
   */
  private $id_user





  /**
   * @return int
   */
  public function getId_Pokemon(){
      return $this->id_pokemon;
  }

  /**
   * @param int $id_pokemon
   * @return Favorie
   */
  public function setId_Pokemon($id_pokemon){
      $this->id_pokemon = $id_pokemon;
      return $this;
  }

  /**
   * @return string
   */
  public function getId_User()
  {
      return $this->id_user;
  }

  /**
   * @param string $id_user
   * @return Favorie
   */
  public function setId_User($id_user)
  {
      $this->id_user = $id_user;
      return $this;
  }

}
