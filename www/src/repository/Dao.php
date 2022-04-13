<?php

namespace App\repository;

use PDO;
use PDOException;

abstract class Dao implements CRUDInterface
{

    private array $cash = [];
    private PDO $pdo;
    public function __construct()
    {

        $this->pdo = new PDO('mysql:host=mysql-nfa114-projet:3306;dbname=db-projet', "user", "ga9399ghr", array(
            PDO::ATTR_PERSISTENT => true
        ));
    }


    /**
     * Get the value of pdo
     */
    protected function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @return  self
     */ 
    protected function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}
