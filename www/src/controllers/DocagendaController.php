<?php

namespace App\controllers;

use App\services\AppointmentService;
use App\utils\tables\TableDocagenda;

class DocagendaController extends AbstractController
{
    private array $bind = ["title" => "Mes rendez-vous"];
    private static string $pageName = "docagenda.php";

    public function docagenda()
    {
        ob_start();

        
        $appointmentService = new AppointmentService();
        $table = new TableDocagenda($appointmentService->getAppointmentByDoctor($_SESSION['auth']->getId_users()), false, false);
        $this->bind['table'] = $table->toHTML();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }


}