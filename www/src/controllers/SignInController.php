<?php

namespace App\controllers;

use App\services\UserService;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;
use App\utils\forms\visitors\VisiteurToHTML;
use Exception;
use PDOException;

class SignInController extends AbstractController
{
    /**
     * The var used in the view
     */
    private array $bind = ["title" => "Connection"];
    /**
     * The form used in the view
     */
    private static array $formBuilder = array('App\utils\forms\builders\SignInForm','get');
    private static string $pageName = "signin.php";


    /**
     * GET /signin
     */
    public function signInGet(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $this->bind["form"] = call_user_func(self::$formBuilder,$action)->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW .  self::$pageName;
        return ob_get_clean();
    }

    /**
     * POST /signin/{args['url]}
     */
    public function signInPost(array $args)
    {
        $action = "{$_SERVER['REQUEST_URI']}";
        $form = call_user_func(self::$formBuilder,$action);
        $form->accept(new VisiteurFillOut($_POST));
        $this->bind['errorMessage'] = '';
        try {
        $userService = new UserService();
        if ($form->accept(new VisiteurIsValid())) {
            $auth = $userService->getAuth($_POST["email"], $_POST["password"]);
            if ($auth !== null) {
                $_SESSION['auth'] = $auth;            
                $host  = $_SERVER['HTTP_HOST'];
                $redirection = "{$args['url']}?{$_SERVER['QUERY_STRING']}";
                header("Location: http://$host/$redirection");
                die();
            } else {
                $errorMessage = 'Mauvais login ou mot de passe';
            }
        }
        } catch(PDOException $e) {
            $errorMessage = "Erreur de connexion à la base donnée";
        } catch(Exception $e) {
            $errorMessage = "Erreur inconnue";
        }
        $this->bind['errorMessage'] = sprintf('<div class="alert-error">%s</div>',$errorMessage);
        $this->bind["form"] = $form->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}
