<?php

namespace App\models;

class Role {
    const TABLE_NAME = 'roles';
    private int|null $id_roles; 
    private string|null $name; 

    public function __construct(int|null $id_roles = null,string|null $name =null)
    {
        $this->id_roles = $id_roles;
        $this->name = $name;
    }

    /**
     * Get the value of id_roles
     */ 
    public function getId_roles()
    {
        return $this->id_roles;
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
}