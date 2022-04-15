<?php


namespace App\models;

class Doctor extends User
{
    const TABLE_NAME = 'doctor';
    private int|null $id_doctor;

    public function __construct(int|null $id_doctor = null,int|null $id_users = null, string|null $password = null, string|null $name = null, string|null $forname = null, string|null $email = null, string|null $tel = null, array $roles = ["DOCTOR"])
    {
        $this->id_doctor = $id_doctor;
        parent::__construct($id_users,  $password,  $name,  $forname,  $email, $tel,  $roles);
    }

    /**
     * Get the value of id_doctor
     */
    public function getId_doctor()
    {
        return $this->id_doctor;
    }
}
