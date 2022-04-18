<?php

namespace App\repository;

use App\models\Appointment;
use Exception;
use PDO;


class AppointmentRepository extends Dao
{



    public function create($role): bool
    {
        return true;
    }
    public function update($role): bool
    {
        return true;
    }
    public function getBy(string $col,string $search): array|Appointment|null
    {
        $sql = 'SELECT *
        FROM have_appointment
        WHERE '.$col.' = ?';
        $statement = $this->getPdo()->prepare($sql);
        $statement->execute(array($search));
        $appointmentArray = $statement->fetchAll();
        foreach ($appointmentArray as $appointment) {
            $appointments[] = new Appointment(
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new DoctorRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = (count($appointments)==1)?$appointments[0]: $appointments ;
        if($appointmentArray === false) {
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
