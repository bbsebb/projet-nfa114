<?php

namespace App\models;

class User
{
    const TABLE_NAME = 'users';
    private int|null $id_users;
    private string|null $password;
    private string|null $name;
    private string|null $forname;
    private string|null $email;
    private string|null $tel;
    private array $roles;

    public function __construct(int|null $id_users = null, string|null $password = null, string|null $name = null, string|null $forname = null, string|null $email = null, string|null $tel = null, array $roles = [])
    {
        $this->id_users = $id_users;
        $this->password = $password;
        $this->name = $name;
        $this->forname = $forname;
        $this->email = $email;
        $this->tel = $tel;
        $this->roles = $roles;
    }

    /**
     * Get the value of id
     */
    public function getId_users()
    {
        return $this->id_users;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId_users($id_users)
    {
        $this->id_users = $id_users;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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

    /**
     * Get the value of tel
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get the value of roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    
}
