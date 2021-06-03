<?php
namespace Model;

use DateTime;
use PDO;
use PhpParser\Node\Arg;


class Article{

    private PDO $pdo;

    private int $id;
    private string $title;
    private DateTime $creationDate;
    private DateTime $modificationDate;
    private bool $validated;
    private string $synopsis;
    private int $idAdmin;
    private string $cat0;
    private string $cat1;
    private array $sections;    

    public function __construct($pdo){
        $this->pdo = $pdo;
        
    }


    public static function fromDict($pdo, $array_article){
        $article = new Article($pdo);
        //title, author, synopsis, cat0, cat1, sections(not good)
        $article->set_object_vars($array_article);
        
        $article->creationDate = date("Y-m-d");
        $article->modificationDate = date("Y-m-d");
        $article->validated = date("Y-m-d");
        $article->idAdmin = -1;
        
        return $article;
    }


    public function createArticle(){
        $sql = "INSERT INTO public.Article";
    }
    
    function set_object_vars(array $vars){
        $has = get_object_vars($this);
        foreach($has as $name => $oldVal){
            $this->$name = isset($vars[$name]) ? $vars[$name] : NULL;
        }
    }

}


?>