<?php

namespace App\controllers;

use App\models\User;
use App\services\UserService;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;
use App\utils\forms\visitors\VisiteurToHTML;
use Exception;
use PDOException;

class ProfileController extends AbstractController
{
    /**
     * The var used in the view
     */
    private array $bind = ["title" => "Profile"];
    /**
     * The form used in the view
     */
    private static array $formBuilder = array('App\utils\forms\builders\SignUpForm', 'get');
    private static string $pageName = "profile.php";

     public function profile():string|false {
        $userService = new UserService();
        $user = $userService->findUserBy("id_users",$_SESSION["auth"]->getId_users());
        $action = "{$_SERVER['REQUEST_URI']}";
        $form = call_user_func(self::$formBuilder, $action);
        $form->accept(new VisiteurFillOut(array(
            "email" => $user->getEmail(), 
            "name" => $user->getName(),
            "forname" =>$user->getForname(),
            "tel" =>$user->getTel(),
        )));
        $this->bind['form'] = $form->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    public function profilePost(array $args)
    {

        $action = "{$_SERVER['REQUEST_URI']}";
        $form = call_user_func(self::$formBuilder, $action);
        $form->accept(new VisiteurFillOut($_POST));
        $this->bind['errorMessage'] = '';
        $userService = new UserService();
        $user = $userService->findUserBy("id_users",$_SESSION["auth"]->getId_users());
        $isEditPassword = (empty($_POST['password2']))?false:true;
        $password = (!$isEditPassword )?$user->getPassword():password_hash($_POST['password'],PASSWORD_DEFAULT);
        try {
            $userService = new UserService();
            $user = new User(
                $_SESSION["auth"]->getId_users(),
                $password,
                $_POST['name'],
                $_POST['forname'],
                $_POST['email'],
                $_POST['tel']
            );
           
            if (!$form->accept(new VisiteurIsValid())) {
                $errorMessage = "Il y a une erreur dans le formulaire";
            } else if ($_POST['password'] !== $_POST['password2'] && $isEditPassword ) {
                $errorMessage = "Les deux mots de passe ne sont pas les mêmes";

            } else if(!$isEditPassword && $userService->getAuth($_POST['email'], $_POST['password'])=== null) {
                $errorMessage = "Mauvais mot de passe";
            } else {
                $userService->editUser($user);
                $_SESSION['auth'] = $userService->getAuth($_POST["email"], $password);
                header("Location: /profile");
            }
        } catch (PDOException $e) {
            $errorMessage = "Erreur de connexion à la base donnée $e";
        } catch (Exception $e) {
            $errorMessage = "Erreur inconnue";
        }
        $this->bind['errorMessage'] = sprintf('<div class="alert-error">%s</div>', $errorMessage);
        $this->bind["form"] = $form->accept(new  VisiteurToHTML(true));
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}