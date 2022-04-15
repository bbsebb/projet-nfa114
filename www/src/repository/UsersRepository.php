<?php

namespace App\repository;

use App\models\User;
use Exception;
use PDO;


class UsersRepository extends Dao
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
        $rtr = $statement->execute($date);
        return $rtr;
    }
    public function update($user): bool
    {
        return true;
    }
    public function getBy(string $col, string $search): array|User|null
    {
        $sql = 'SELECT * 
        FROM users
        WHERE ' . $col . ' = ?';
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($search));
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "App\models\User");
        $rowCount = $statement->rowCount();
        if ($rowCount > 1) {
            $userArray = $statement->fetchAll();
            $rtr = $userArray;
        } else {
            $user = $statement->fetch();
            $roleRepo = new RolesRepository();
            if ($user === false) {
                $rtr = null;
            } else {
                $roles = $roleRepo->getBy("id_users", $user->getId_users());
                $user->setRoles($roles);
                $rtr = $user;
            }
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
