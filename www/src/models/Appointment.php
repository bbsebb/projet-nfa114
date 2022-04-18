<?php


namespace App\models;

use DateTime;

class Appointment 
{
    const TABLE_NAME = 'appointment';
    private Doctor|null $doctor;
    private User|null $user;
    private DateTime|null $datetime_start;
    private DateTime|null $datetime_end;

    public function __construct(Doctor|null $doctor = null,User|null $user = null, DateTime|null $datetime_start, DateTime|null $datetime_end)
    {
        $this->doctor = $doctor;
        $this->user = $user;
        $this->datetime_start = $datetime_start;
        $this->datetime_end = $datetime_end;
        
    }


    /**
     * Get the value of doctor
     */ 
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set the value of doctor
     *
     * @return  self
     */ 
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of datetime_start
     */ 
    public function getDatetime_start()
    {
        return $this->datetime_start;
    }

    /**
     * Set the value of datetime_start
     *
     * @return  self
     */ 
    public function setDatetime_start($datetime_start)
    {
        $this->datetime_start = $datetime_start;

        return $this;
    }

    /**
     * Get the value of datetime_end
     */ 
    public function getDatetime_end()
    {
        return $this->datetime_end;
    }

    /**
     * Set the value of datetime_end
     *
     * @return  self
     */ 
    public function setDatetime_end($datetime_end)
    {
        $this->datetime_end = $datetime_end;

        return $this;
    }
}