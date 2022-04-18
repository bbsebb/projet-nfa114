<?php

namespace App\controllers;

use App\configs\ConfigOpeningTime;
use App\configs\ConfigOpeningTimePermissions;
use App\utils\forms\builders\AgendaForm;
use App\utils\forms\visitors\VisiteurToHTML;
use DateInterval;

class AgendaController extends AbstractController
{


    private array $bind = ["title" => "Prise de rdv"];
    private static string $pageName = "agenda.php";
    public function agenda()
    {
        $this->bind['form']= (new AgendaForm())->get()->accept(new VisiteurToHTML());
        $configOpeningTime = (new ConfigOpeningTime())->get();
        $duration = new DateInterval("PT30M");
        $OpeningTimeAMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["AM"];
        $OpeningTimePMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["PM"];
        
       
        for ($i=0,$date=date_create('00:00:00'); $date->format('U') - date_create('23:30:00')->format('U')<0; $date->add($duration),$i++) { 
            $strDate = $date->format('H:i');
            if( ($strDate >= $OpeningTimeAMtoday[0] && $strDate < $OpeningTimeAMtoday[1]) || ($strDate >= $OpeningTimePMtoday[0] && $strDate < $OpeningTimePMtoday[1])  ) {
                $timeSlots[$i] = clone $date;
            }   
        }
        $this->bind['timeSlot'] = '';
        foreach($timeSlots as $startTime) {
            $this->bind['timeSlot'] .= sprintf('<p>%s</p>',$startTime->format('H:i')); 
        }
        

        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}