<?php

namespace App\services;

use App\models\Doctor;
use App\repository\Dao;
use App\repository\DoctorRepository;


class DoctorService
{

    private Dao $doctorRepository;

    public function __construct()
    {
        $this->doctorRepository = new DoctorRepository();
    }

    public function getAllDoctors()
    {
        return $this->doctorRepository->getAll();
    }

    public function getByID(int $id): Doctor|null
    {
        return $this->doctorRepository->getBy('id_doctor', $id);
    }



    public function addDoctor(Doctor $doctor): bool
    {
        return $this->doctorRepository->create($doctor);
    }

    public function delDoctor(int $id_doctor): bool
    {

        return $this->doctorRepository->delete($this->getByID($id_doctor));
    }
}
