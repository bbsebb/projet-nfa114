<?php

namespace App\repository;

use App\models\Appointment;
use DateTime;
use Exception;
use PDO;


class AppointmentRepository extends Dao
{



    public function create($appointment): bool
    {
        $sql = 'INSERT INTO have_appointment
                (id_users,id_doctor,datetime_start,datetime_end) VALUE (?,?,?,?)';    
        $value = array(
            $appointment->getUser()->getId_users(),
            $appointment->getDoctor()->getId_doctor(),
            $appointment->getDatetime_start()->format('y-m-d H:i:s'),
            $appointment->getDatetime_end()->format('y-m-d H:i:s')
        );
        
        $statement = $this->getPdo()->prepare($sql);
        $rtr = $statement->execute($value);        
        return $rtr;
    }
    public function update($appointment): bool
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
                $appointment['id_have_appointment'],
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new UsersRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = (is_array($appointments) && count($appointments)==1)?$appointments[0]: $appointments ;
        if($appointmentArray === false) {
            $rtr = null;
        }
        return $rtr;
    }

    public function getById_DoctorAndDate(int $id_doctor,DateTime $date): array|null
    {
        $sql = 'SELECT *
        FROM have_appointment
        WHERE id_doctor = ? AND DATE_FORMAT(datetime_start,"%d-%m-%Y") = ? ';
        $statement = $this->getPdo()->prepare($sql);
        $search = array($id_doctor,$date->format("d-m-Y"));
        $statement->execute($search);
        $appointmentArray = $statement->fetchAll();
        $appointments=[];
        foreach ($appointmentArray as $appointment) {
            $appointments[] = new Appointment(
                $appointment['id_have_appointment'],
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new UsersRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = $appointments;
        if($appointmentArray === false) {
            $rtr = null;
        }
        return $rtr;
    }

    public function getById_UsersAndId_DoctorAndDate(int $id_users,int $id_doctor,DateTime $date): array|null
    {
        $sql = 'SELECT *
        FROM have_appointment
        WHERE id_users = ? AND id_doctor = ? AND DATE_FORMAT(datetime_start,"%d-%m-%Y") = ? ';
        $statement = $this->getPdo()->prepare($sql);
        $search = array($id_users,$id_doctor,$date->format("d-m-Y"));
        $statement->execute($search);
        $appointmentArray = $statement->fetchAll();
        $appointments = [];
        foreach ($appointmentArray as $appointment) {
            $appointments[] = new Appointment(
                $appointment['id_have_appointment'],
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new UsersRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = $appointments;
        if($appointmentArray === false) {
            $rtr = null;
        }
        return $rtr;
    } 
    public function getById_Users(int $id_users): array|null
    {
        $sql = 'SELECT *
        FROM have_appointment
        WHERE id_users = ? ';
        $statement = $this->getPdo()->prepare($sql);
        $search = array($id_users);
        $statement->execute($search);
        $appointmentArray = $statement->fetchAll();
        $appointments = [];
        foreach ($appointmentArray as $appointment) {
            $appointments[] = new Appointment(
                $appointment['id_have_appointment'],
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new UsersRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = $appointments;
        if($appointmentArray === false) {
            $rtr = null;
        }
        return $rtr;
    } 

    public function getById_Doctor(int $id_doctor): array|null
    {
        $sql = 'SELECT *
        FROM have_appointment
        WHERE id_doctor = (SELECT id_doctor FROM doctor WHERE id_users  = ?) ';
        $statement = $this->getPdo()->prepare($sql);
        $search = array($id_doctor);
        $statement->execute($search);
        $appointmentArray = $statement->fetchAll();
        $appointments = [];
        foreach ($appointmentArray as $appointment) {
            $appointments[] = new Appointment(
                $appointment['id_have_appointment'],
                (new DoctorRepository())->getBy("id_doctor",$appointment['id_doctor']),
                (new UsersRepository())->getBy("id_users",$appointment['id_users']),
            date_create($appointment['datetime_start']),
            date_create($appointment['datetime_end']));
        }
        $rtr = $appointments;
        if($appointmentArray === false) {
            $rtr = null;
        }
        
        return $rtr;
    }

    public function getAll(): array|null
    {
        return null;
    }
    public function delete($id_have_appointment): bool
    {
        $sql = 'DELETE FROM have_appointment WHERE id_have_appointment = ?';
        $statement = $this->getPdo()->prepare($sql);
        return $statement->execute(array($id_have_appointment)); 
    }
}
