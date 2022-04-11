<?php

namespace App\controllers;

use App\services\UserService;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;
use App\utils\forms\visitors\VisiteurToHTML;

class SignUpController extends AbstractController
{
    /**
     * The var used in the view
     */
    private array $bind = ["title" => "Inscription"];
    /**
     * The form used in the view
     */
    private static array $formBuilder = array('App\utils\forms\builders\SignUpForm','get');
    private static string $pageName = "signup.php";

    /**
     * GET /signup
     */
    public function signUpGet(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $this->bind['form'] = call_user_func(self::$formBuilder,$action);
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    /**
     * POST /signup/{args['url]}
     */
    public function signUpPost(array $args)
    {
        $userService = new UserService();
        $action = "{$_SERVER['REQUEST_URI']}";
        $form = call_user_func(self::$formBuilder,$action);
        $this->bind["form"] = $form;
        ob_start();
        require_once DIR_VIEW .self::$pageName;
        return ob_get_clean();
    }
}
