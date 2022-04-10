<?php

namespace App\services;

use App\models\Auth;
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
        if(isset($user) && $user->getPassword() === $password) {
            $auth = new Auth($user->getName(),$user->getForname(),$user->getEmail(), []);
        }
        return $auth;
    }
}