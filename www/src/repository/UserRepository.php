<?php

namespace App\repository;

use App\models\User;
use PDO;

class UserRepository extends Dao
{



    public function create($entitie): User|null
    {

        return null;
    }
    public function update($entitie): bool
    {
        return true;
    }
    public function getBy(string $col,string $search): User|null
    {
        $sql = 'SELECT * 
        FROM users
        WHERE '.$col.' = ?';

        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($search));
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , "App\models\User");
        $user = $statement->fetch();
        if($user === false) {
            $user = null;
        }
        return $user;
    }
    public function getByAll(): array|null
    {
        return null;
    }
    public function delete($entitie): bool
    {
        return true;
    }
}
