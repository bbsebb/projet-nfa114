<?php
namespace App\models;

class Auth {

    private string $id_users;
    private string $name;
    private string $forname;
    private array $roles;
    private string $email;

    public function __construct(string $id_users,string $name,string $forname,string $email,array $roles)
    {
        $this->id_users = $id_users;
        $this->name = $name;
        $this->forname = $forname;
        $this->email = $email;
        $this->roles = $roles;
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
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function rolesToArray(): array
    {
        $rtr = [];
        foreach ($this->roles as $role) {
            $rtr[] = $role->getName();
        }
        return $rtr;
    }

    public function hasRoles(array $roles):bool {
        return Auth::isAuthorized($this,$roles);
    }

    public static function isAuthorized(Auth $auth,array $roles):bool {
        $flag = true;
        if ($auth !== null && count($roles)>0) {
            $flag = count(array_intersect($roles, $auth->rolesToArray())) > 0;
        }
        return $flag;
    }

    /**
     * Get the value of id_users
     */ 
    public function getId_users()
    {
        return $this->id_users;
    }

    /**
     * Set the value of id_users
     *
     * @return  self
     */ 
    public function setId_users($id_users)
    {
        $this->id_users = $id_users;

        return $this;
    }
}