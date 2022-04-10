<?php

namespace App\controllers;

use App\services\UserService;
use App\utils\forms\builders\ConnexionForm;
use App\utils\forms\components\Form;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;

class SignInController extends AbstractController
{
    private array $bind = ["title" => "Connection"];




    public function signInGet(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $this->bind["form"] = ConnexionForm::get($action);
        ob_start();
        require_once DIR_VIEW . "signin.php";
        return ob_get_clean();
    }

    public function signInPost(array $args)
    {
        $userService = new UserService();
        $action = "{$_SERVER['REQUEST_URI']}";
        $form = ConnexionForm::get($action);

        $form->accept(new VisiteurFillOut($_POST));
        if ($form->accept(new VisiteurIsValid())) {
            $auth = $userService->getAuth($_POST["email"], $_POST["password"]);
            if ($auth !== null) {
                $_SESSION['auth'] = $auth;            
                $host  = $_SERVER['HTTP_HOST'];
                $redirection = "{$args['url']}?{$_SERVER['QUERY_STRING']}";
                header("Location: http://$host/$redirection");
                die();
            } else {
                $this->bind['errorMessage'] = "Mauvais login ou mot de passe";
            }
        }
        $this->bind["form"] = $form;
        ob_start();
        require_once DIR_VIEW . "signin.php";
        return ob_get_clean();
    }
}
