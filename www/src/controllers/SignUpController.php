<?php

namespace App\controllers;

use App\models\User;
use App\services\UserService;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;
use App\utils\forms\visitors\VisiteurToHTML;
use Exception;
use PDOException;

class SignUpController extends AbstractController
{
    /**
     * The var used in the view
     */
    private array $bind = ["title" => "Inscription"];
    /**
     * The form used in the view
     */
    private static array $formBuilder = array('App\utils\forms\builders\SignUpForm', 'get');
    private static string $pageName = "signup.php";

    /**
     * GET /signup
     */
    public function signUpGet(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $this->bind['form'] = call_user_func(self::$formBuilder, $action)->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    /**
     * POST /signup/{args['url]}
     */
    public function signUpPost(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $form = call_user_func(self::$formBuilder, $action);
        $form->accept(new VisiteurFillOut($_POST));
        $this->bind['errorMessage'] = '';
        try {
            $userService = new UserService();
            $user = new User(
                -1,
                password_hash($_POST['password'],PASSWORD_DEFAULT),
                $_POST['name'],
                $_POST['forname'],
                $_POST['email'],
                $_POST['tel']
            );
           
            if (!$form->accept(new VisiteurIsValid())) {
                $errorMessage = "Il y a une erreur dans le formulaire";
            } else if ($_POST['password'] !== $_POST['password2']) {
                $errorMessage = "Les deux mots de passe ne sont pas les mêmes";

            } else {
                $userService->addUser($user);
                header("Location: /");
            }
        } catch (PDOException $e) {
            $errorMessage = "Erreur de connexion à la base donnée";
        } catch (Exception $e) {
            $errorMessage = "Erreur inconnue";
        }
        $this->bind['errorMessage'] = sprintf('<div class="alert-error">%s</div>', $errorMessage);
        $this->bind["form"] = $form->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}
