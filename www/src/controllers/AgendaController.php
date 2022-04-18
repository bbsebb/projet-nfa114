<?php

namespace App\controllers;

use App\configs\ConfigOpeningTime;
use App\configs\ConfigOpeningTimePermissions;
use App\models\Doctor;
use App\repository\AppointmentRepository;
use App\services\DoctorService;
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
        $service = new DoctorService();   
        $this->bind['timeSlot'] = $this->timeSlotToHtml($service->getById(1));
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    private function timeSlotToHtml(Doctor $doctor,ConfigOpeningTime $configOpeningTime =new ConfigOpeningTime(),  $duration = new DateInterval("PT30M")) {
        $service = new AppointmentRepository();
        dump($service->getBy("id_doctor",1));
        $configOpeningTime =  $configOpeningTime->get();
        $OpeningTimeAMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["AM"];
        $OpeningTimePMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["PM"];
        for ($i=0,$date=date_create('00:00:00'); $date->format('U') - date_create('23:30:00')->format('U')<0; $date->add($duration),$i++) { 
            $strDate = $date->format('H:i');
            if( ($strDate >= $OpeningTimeAMtoday[0] && $strDate < $OpeningTimeAMtoday[1]) || ($strDate >= $OpeningTimePMtoday[0] && $strDate < $OpeningTimePMtoday[1])  ) {
                $timeSlots[$i] = clone $date;
            }   
        }
        $timeSlothtml = '<div id="timeslots">';
        foreach($timeSlots as $startTime) {
            $timeSlothtml .= sprintf('<input type="button" value="%s">',$startTime->format('H:i')); 
        }
        $timeSlothtml .='</div>';
        return $timeSlothtml;
    }
}