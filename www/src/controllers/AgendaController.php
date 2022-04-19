<?php

namespace App\controllers;

use App\configs\ConfigOpeningTime;
use App\configs\ConfigOpeningTimePermissions;
use App\models\Appointment;
use App\models\Doctor;
use App\repository\AppointmentRepository;
use App\services\AppointmentService;
use App\services\DoctorService;
use App\utils\forms\builders\AgendaForm;
use App\utils\forms\visitors\VisiteurToHTML;
use DateInterval;
use DateTimeImmutable;

class AgendaController extends AbstractController
{


    private array $bind = ["title" => "Prise de rdv"];
    private static string $pageName = "agenda.php";
    public function agenda()
    {
        $this->bind['form'] = (new AgendaForm())->get()->accept(new VisiteurToHTML());
        $service = new DoctorService();
        $this->bind['timeSlot'] = $this->timeSlotToHtml($service->getById(1));
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    private function timeSlotToHtml(Doctor $doctor, ConfigOpeningTime $configOpeningTime = new ConfigOpeningTime(), DateInterval  $duration = new DateInterval("PT30M"))
    {

        $timeSlothtml = '<div id="timeslots">';
        $timeslots = $this->createTimeslots($configOpeningTime, $duration);
        $this->addOccupiedInfoToTimeslots($timeslots,$duration);
        $this->addOccupiedByUserInfoToTimeslots($timeslots,$duration);
        // For each timeslots
        foreach ($timeslots as $timeslot) {
            $class ='';
            if($timeslot['occupied']) {
                $class= 'class="slot-occupied"';
            } 
            if($timeslot['made']) {
                $class= 'class="slot-made"';
            } 
            $timeSlothtml .= sprintf('<input type="button" %s value="%s">',$class, $timeslot['datetime']->format('H:i'));

        }
        $timeSlothtml .= '</div>';

        return $timeSlothtml;
    }

    /**
     * Create a timeslot array for today
     * @param ConfigOpeningTime $configOpeningTime is the OpeningTime for the timeslots
     * @param DateInterval $duration is the timeslots duration
     */
    private function createTimeslots(ConfigOpeningTime $configOpeningTime, DateInterval $duration): array
    {
        $configOpeningTime =  $configOpeningTime->get();
        $OpeningTimeAMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["AM"];
        $OpeningTimePMtoday = $configOpeningTime[strtolower(getdate()['weekday'])]["PM"];
        // Create for today
        for ($i = 0, $date = date_create('00:00:00'); $date->format('U') - date_create('23:30:00')->format('U') < 0; $date->add($duration) ) {
            $strDate = $date->format('H:i');
            // If it's in the opening time
            if (($strDate >= $OpeningTimeAMtoday[0] && $strDate < $OpeningTimeAMtoday[1]) || ($strDate >= $OpeningTimePMtoday[0] && $strDate < $OpeningTimePMtoday[1])) {
                $timeSlots[$i]["datetime"] = clone $date;
                $i++;
            }
        }
        return $timeSlots;
    }

    private function addOccupiedInfoToTimeslots(array &$timeslots,DateInterval $duration):array
    {
        $appointmentService = new AppointmentService();
        $appointments = $appointmentService->getAppointmentById_DoctorAndDate( 1, date_create("now"));
        return $this->addInfoToTImeslots($timeslots,$duration,'occupied',$appointments);
    }

    private function addOccupiedByUserInfoToTimeslots(array &$timeslots,DateInterval $duration):array {
        $appointmentService = new AppointmentService();
        $appointments = $appointmentService->getAppointmentById_UsersAndDate( 2, date_create("now"));
        return $this->addInfoToTImeslots($timeslots,$duration,'made',$appointments);
         
    }

    private function addInfoToTImeslots(array &$timeslots,DateInterval $duration,string $info,array $appointments):array {
        for ($i=0; $i < count($timeslots); $i++) {
            $startTime = $timeslots[$i]['datetime'];
            $endTime = (clone $startTime)->add($duration);
            // Flag intersection
            $intersection = false;
            // We check if the timeslot is free or no comparing the doctor appointments 
            foreach ($appointments as $appointment) {
                $startAppointment = $appointment->getDatetime_start();
                $endAppointment = $appointment->getDatetime_end();
                //If the appointment starts before and ends after the slot
                if ($startTime > $startAppointment && $endTime < $endAppointment) {
                    $intersection = $intersection || true;
                }
                //If there is an overlap
                else if (($startTime >= $startAppointment && $startTime <= $endAppointment) || ($endTime >= $startAppointment && $endTime <= $endAppointment)) {
                    // We check that it is not an appointment that ends and starts at the same time
                    $orderTime = array($startTime, $startAppointment, $endTime, $endAppointment);
                    // On tri les 4 date pour determiner l'intersection du creneau et du rdv              
                    sort($orderTime);
                    // If the intersection is different from 0, there is an overlap
                    if ($orderTime[2]->format('U') - $orderTime[1]->format('U') != 0) {
                        $intersection = $intersection || true;
                    }
                }
            }
            $timeslots[$i][$info] = $intersection;
        }
        return $timeslots;
    }
}
