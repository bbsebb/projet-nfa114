<?php

namespace App\controllers;

use App\utils\forms\builders\AgendaForm;
use App\utils\forms\visitors\VisiteurToHTML;

class AgendaController extends AbstractController
{


    private array $bind = ["title" => "Prise de rdv"];
    private static string $pageName = "agenda.php";
    public function agenda()
    {
        $this->bind['form']= (new AgendaForm())->get()->accept(new VisiteurToHTML());
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}