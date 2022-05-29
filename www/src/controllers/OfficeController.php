<?php

namespace App\controllers;

use App\configs\ConfigOpeningTime;
use App\services\DoctorService;
use App\utils\tables\Table;
use App\utils\tables\TableDoctor;

class OfficeController extends AbstractController
{
    private array $bind = ["title" => "Accueil"];
    private static string $pageName = "home.php";
    public function office()
    {
        ob_start();
        $serviceDoctor = new DoctorService();
        $table_doc = new TableDoctor($serviceDoctor->getAllDoctors(), false, false);
        $this->bind['table_doc'] = $table_doc->toHTML();
        $tableConfig = (new ConfigOpeningTime())->get();
        $tableConfigToOpen = array();
        $i = 0;
        foreach ($tableConfig as $key => $value) {
            $tableConfigToOpen[$i][] = $key;
            if (isset($value["AM"])) {
                $tableConfigToOpen[$i][] = isset($value["AM"][0]) ? $value["AM"][0] : 'Fermé';
                $tableConfigToOpen[$i][] = isset($value["AM"][1]) ? $value["AM"][1] : '';
            }
            if (isset($value["PM"])) {
                $tableConfigToOpen[$i][] = isset($value["PM"][0]) ? $value["PM"][0] : 'Fermé';
                $tableConfigToOpen[$i][] = isset($value["PM"][1]) ? $value["PM"][1] : '';
            }
            $i++;
        }
        $table_open = new Table($tableConfigToOpen,['Jour','Matin','','Après-midi','']);
        $this->bind['table_open'] = $table_open->toHTML();

        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}
