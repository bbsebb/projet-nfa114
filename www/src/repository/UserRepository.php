<?php

namespace App\repository;

use App\models\User;
use Exception;
use PDO;


class UserRepository extends Dao
{



    public function create($user): bool
    {
        $sql = '
        INSERT INTO users (name,forname,email,password,tel) VALUES (?,?,?,?,?)
        ';
        $date = array(
            $user->getName(),
            $user->getForname(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getTel()
        );
        $statement = $this->getPdo()->prepare($sql);
        return $statement->execute($date);
    }
    public function update($user): bool
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
    public function delete($user): bool
    {
        return true;
    }
}
