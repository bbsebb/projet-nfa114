<?php

namespace App\controllers;

use App\services\AppointmentService;
use App\utils\tables\TableAppointments;

class MyappointmentController extends AbstractController
{
    private array $bind = ["title" => "Mes rendez-vous"];
    private static string $pageName = "myappointment.php";

    public function myappointment()
    {
        ob_start();

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
        
        $appointmentService = new AppointmentService();
        $table = new TableAppointments($appointmentService->getAppointmentByUser($_SESSION['auth']->getId_users()), false, true);
        $this->bind['table'] = $table->toHTML();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    public function delAppointment(array $params) {
        $appointmentService = new AppointmentService();
        $appointmentService->delAppointment($params["id"]);
        header("Location: /myappointment?success=del");
    }
}