<?php

namespace App\controllers;

use App\services\DoctorService;
use App\utils\tables\Table;
use App\utils\tables\TableDoctor;

class AdminController extends AbstractController
{
    private array $bind = ["title" => "Administration"];
    public function admin()
    {
        $serviceDoctor = new DoctorService();
        

        $table = new TableDoctor($serviceDoctor->getAllDoctors(),true,true);
        
        
        $this->bind['table'] = $table->toHTML();
        ob_start();
        require_once DIR_VIEW . "admin.php";
        return ob_get_clean();
    }
}
