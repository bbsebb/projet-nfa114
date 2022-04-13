<?php

namespace App\repository;

use App\models\User;
use Exception;
use PDO;


class RolesRepository extends Dao
{



    public function create($role): bool
    {
        return true;
    }
    public function update($role): bool
    {
        return true;
    }
    public function getBy(string $col,string $search): array|User|null
    {
        $sql = 'SELECT r.id_roles,r.name
        FROM roles r
        INNER JOIN has_role hr USING(id_roles)
        WHERE '.$col.' = ?';
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($search));
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , "App\models\Role");
            $userArray = $statement->fetchAll();
            $rtr = $userArray ;
        if($userArray === false) {
            $rtr = null;
        }
        return $rtr;
    }
    public function getAll(): array|null
    {
        return null;
    }
    public function delete($user): bool
    {
        return true;
    }
}
