<?php

namespace App\services;

use App\models\Appointment;
use App\models\Doctor;
use App\models\User;
use App\repository\AppointmentRepository;
use App\repository\Dao;
use App\repository\UsersRepository;
use DateTime;

class AppointmentService
{

    private Dao $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
        $this->usersService = new UserService();
        $this->doctorService = new DoctorService();
    }
    

    public function createAppointment($idUsers,$idDoctor,$datetimeStart,$dateTimeEnd) {
        $user=  $this->usersService->findUserBy("id_users",$idUsers);
        $doc=  $this->doctorService->getByID($idDoctor);      
        return $this->appointmentRepository->create(new Appointment(null,$doc,$user,$datetimeStart,$dateTimeEnd));
    }

    public function getAppointmentByDoctorAndDate(Doctor $doctor, DateTime $date ) {
        return $this->getAppointmentById_DoctorAndDate($doctor->getId_doctor(),$date);
    }

    public function getAppointmentById_DoctorAndDate(int $id_doctor, DateTime $date ) {

        return $this->appointmentRepository->getById_DoctorAndDate($id_doctor,$date);
    }

    public function getAppointmentByUserAndDate(User $user,Doctor $doctor, DateTime $date ) {
        return $this->getAppointmentById_UsersAndId_DoctorAndDate($user->getId_users(),$doctor->getId_doctor(),$date);
    }

    public function getAppointmentByUser(int $id_users) {
        return $this->appointmentRepository->getById_Users($id_users);
    }

    public function getAppointmentByDoctor(int $id_doctor) {
        return $this->appointmentRepository->getById_Doctor($id_doctor);
    }

    public function getAppointmentById_UsersAndId_DoctorAndDate(int $id_users,int $doctor, DateTime $date ) {

        return $this->appointmentRepository->getById_UsersAndId_DoctorAndDate($id_users,$doctor,$date);
    }

    public function delAppointment(int $id_have_appointment): bool
    {

        return $this->appointmentRepository->delete($id_have_appointment);
    }

    
}