<?php

namespace App\controllers;



class SignOutController extends AbstractController
{



    /**
     * GET /signin
     */
    public function signOut(array $args)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: /");
        die();
    }
}
