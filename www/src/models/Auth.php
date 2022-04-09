<?php
namespace App\models;

class Auth {

    private string $name;
    private string $forname;
    private array $role;
    private string $email;

    public function __construct(string $name,string $forname,array $role,string $email)
    {
        $this->$name = $name;
        $this->$forname = $forname;
        $this->$email = $email;
        $this->$role = $role;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of forname
     */ 
    public function getForname()
    {
        return $this->forname;
    }

    /**
     * Set the value of forname
     *
     * @return  self
     */ 
    public function setForname($forname)
    {
        $this->forname = $forname;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}