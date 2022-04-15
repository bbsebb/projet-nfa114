<?php

namespace App\repository;

use App\models\Doctor;
use PDO;

class DoctorRepository extends UsersRepository
{
    public function create($doctor): bool
    {
        $sql = '
        INSERT INTO users (name,forname,email,password,tel) VALUES (?,?,?,?,?);
        SELECT @last_id := LAST_INSERT_ID( );
        INSERT INTO doctor(id_users) VALUE (@last_id );
        INSERT INTO has_role (id_users,id_roles) VALUE (@last_id, (SELECT id_roles FROM roles WHERE name="DOCTOR") );';
        $date = array(
            $doctor->getName(),
            $doctor->getForname(),
            $doctor->getEmail(),
            $doctor->getPassword(),
            $doctor->getTel()
        );
        $statement = $this->getPdo()->prepare($sql);
        $rtr = $statement->execute($date);
        return $rtr;
    }
    public function update($user): bool
    {
        return true;
    }
    public function getBy(string $col, string $search): array|Doctor|null
    {
        $sql = 'SELECT * 
        FROM users
        INNER JOIN doctor USING(id_users)
        WHERE ' . $col . ' = ?';
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($search));
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "App\models\Doctor");
        $rowCount = $statement->rowCount();
        $roleRepo = new RolesRepository();
        if ($rowCount > 1) {
            $doctorArray = $statement->fetchAll();
            foreach ($doctorArray as $doctor) {
                $roles = $roleRepo->getBy("id_users", $doctor->getId_users());
                $doctor->setRoles($roles);
            }
            $rtr = $doctorArray;
        } else {
            $doctor = $statement->fetch();
            if ($doctor === false) {
                $rtr = null;
            } else {
                $roles = $roleRepo->getBy("id_users", $doctor->getId_users());
                $doctor->setRoles($roles);
                $rtr = $doctor;
            }
        }
        return $rtr;
    }
    public function getAll(): array|null
    {
        $sql = 'SELECT * 
        FROM users
        INNER JOIN doctor USING(id_users)';

        $statement = $this->getPdo()->query($sql, PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "App\models\Doctor");
        $doctorArray = $statement->fetchAll();
        $roleRepo = new RolesRepository();
        foreach ($doctorArray as $doctor) {
            $roles = $roleRepo->getBy("id_users", $doctor->getId_users());
            $doctor->setRoles($roles);
        }
        return ($doctorArray == false) ? null : $doctorArray;
    }

    public function delete($user): bool
    {
        return true;
    }
}
