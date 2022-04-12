<?php

namespace App\services;

use App\models\Auth;
use App\models\User;
use App\repository\Dao;
use App\repository\UserRepository;

class UserService {

    private Dao $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAuth(string $email, string $password):Auth|null {
        $user = $this->userRepository->getBy("email",$email);
        
        $auth = null;
        if(isset($user) && password_verify($password, $user->getPassword()) ) {
            $auth = new Auth($user->getName(),$user->getForname(),$user->getEmail(), []);
        }
        return $auth;
    }

    public function addUser(User $user):bool {
        return $this->userRepository->create($user);
    }

    public function userExist($email):bool{
        return ($this->userRepository->getBy("email",$email) !== null);
    }
}