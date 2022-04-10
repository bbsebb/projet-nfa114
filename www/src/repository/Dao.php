<?php 

namespace App\repository;

use PDO;
use PDOException;

abstract class Dao implements CRUDInterface{

    private array $cash = [];
    private PDO $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=172.20.0.2:3306;dbname=db-projet', "user", "ga9399ghr",array(
                PDO::ATTR_PERSISTENT => true
            ));
        
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }


    /**
     * Get the value of pdo
     */ 
    protected function getPdo()
    {
        return $this->pdo;
    }


}