<?php

namespace App\services;

use App\models\Doctor;
use App\models\User;
use App\repository\AppointmentRepository;
use App\repository\Dao;
use DateTime;

class AppointmentService
{

    private Dao $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
    }

    public function getAppointmentByDoctorAndDate(Doctor $doctor, DateTime $date ) {
        return $this->getAppointmentById_DoctorAndDate($doctor->getId_doctor(),$date);
    }

    public function getAppointmentById_DoctorAndDate(int $id_doctor, DateTime $date ) {

        return $this->appointmentRepository->getById_DoctorAndDate($id_doctor,$date);
    }

    public function getAppointmentByUserAndDate(User $user, DateTime $date ) {
        return $this->getAppointmentById_UsersAndDate($user->getId_users(),$date);
    }

    public function getAppointmentById_UsersAndDate(int $id_users, DateTime $date ) {

        return $this->appointmentRepository->getById_UsersAndDate($id_users,$date);
    }

    
}