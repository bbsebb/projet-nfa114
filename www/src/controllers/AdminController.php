<?php

namespace App\controllers;

use App\models\Doctor;
use App\models\User;
use App\services\DoctorService;
use App\services\UserService;
use App\utils\forms\builders\AdminForm;
use App\utils\forms\visitors\VisiteurFillOut;
use App\utils\forms\visitors\VisiteurIsValid;
use App\utils\forms\visitors\VisiteurToHTML;
use App\utils\tables\Table;
use App\utils\tables\TableDoctor;
use Exception;
use PDOException;

class AdminController extends AbstractController
{
    private array $bind = ["title" => "Administration","errorMessage" => '',"success"=>''];
    private static string $pageName = "admin.php";
    private static array $formBuilder = array('App\utils\forms\builders\AdminForm', 'get');
    

    public function adminGet():string|false
    {
        $this->table();
        $this->bind["success"] = '';
        if(isset($_GET["success"]) && $_GET["success"]) {
            
             switch ($_GET["success"]) {
                case 'del':
                    $msg = 'Suppression effectuée';
                    break;
                default:
                    $msg = 'Opération réussie';
                    break;
            }
            $this->bind['success'] = '<div class="success">'.$msg.'</div> ';
        }
        $this->bind['form'] = call_user_func(self::$formBuilder)->accept(new  VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    public function adminPost():string|false
    {
        
        $this->table();
        $pass = bin2hex(openssl_random_pseudo_bytes(4));
        $form = call_user_func(self::$formBuilder);
        $form->accept(new VisiteurFillOut($_POST));
        $this->bind['errorMessage'] = '';
        try {
            $doctorService = new DoctorService();
            $doctor = new Doctor(
                -1,
                -1,
                password_hash($pass,PASSWORD_DEFAULT),
                $_POST['name'],
                $_POST['forname'],
                $_POST['email'],
                $_POST['tel']
            );
            
            if (!$form->accept(new VisiteurIsValid())) {        
                $errorMessage = "Il y a une erreur dans le formulaire";
            } else {
                
                $doctorService->addDoctor($doctor);
                mail('sebastien.burckhardt@gmail.com', 'Mon Sujet', $pass);
                header("Location: /admin");
            }
        } catch (PDOException $e) {
            
            $errorMessage = "Erreur de connexion à la base donnée $e";
        } catch (Exception $e) {
            $errorMessage = "Erreur inconnue";
        }
        $this->bind["success"] = '';
        $this->bind['errorMessage'] = sprintf('<div class="alert-error">%s</div>', $errorMessage);
        $this->bind["form"] = $form->accept(new  VisiteurToHTML(true));
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    public function delDoc(array $params):void
    {
        $doctorService = new DoctorService();
        $doctorService->delDoctor($params["id"]);
        header("Location: /admin?success=del");
    }

    private function table(): void
    {
        $serviceDoctor = new DoctorService();
        $table = new TableDoctor($serviceDoctor->getAllDoctors(), false, true);
        $this->bind['table'] = $table->toHTML();
    }
}
