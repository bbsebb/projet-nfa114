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
use DateTime;
use DateTimeImmutable;

class AgendaController extends AbstractController
{


    private array $bind = ["title" => "Prise de rdv"];
    private static string $pageName = "agenda.php";
    private string  $durationStr = "PT30M";
    public function agenda()
    {
        $this->bind['form'] = (new AgendaForm())->get()->accept(new VisiteurToHTML());

        $this->bind['timeSlot'] = $this->timeSlotToHtml(1);
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }

    public function ajaxGet(array $args)
    {

        echo $this->timeSlotToHtml($args['id'], new DateTime($args['date']));
        die();
    }

    public function ajaxPost(array $args)
    {
        $duration = new DateInterval($this->durationStr);
        $appointmentService = new AppointmentService();
        list($hour, $min) = explode(':', $_POST['time']);
        $datetimeStart = (new DateTime($args['date']))->setTime($hour, $min);
        $datetimeEnd = (clone $datetimeStart)->add($duration);
        $appointmentService->createAppointment($_SESSION['auth']->getId_users(), $args['id'],$datetimeStart,$datetimeEnd);
        die();
    }

    private function timeSlotToHtml(int $doctor, DateTime $date = new DateTime("now"), ConfigOpeningTime $configOpeningTime = new ConfigOpeningTime(), DateInterval  $duration = new DateInterval("PT30M"))
    {
        $duration = new DateInterval($this->durationStr);
        $timeSlothtml = '';

        $timeslots = $this->createTimeslots($configOpeningTime, $duration, $date);
        $this->addOccupiedInfoToTimeslots($timeslots, $doctor, $duration, $date);
        $this->addOccupiedByUserInfoToTimeslots($timeslots, $doctor, $duration, $date);
        
        // For each timeslots
        foreach ($timeslots as $timeslot) {
            $class = '';
            if ($timeslot['occupied']) {
                $class = 'class="slot-occupied"';
            }
            if ($timeslot['made']) {
                $class = 'class="slot-made"';
            }
            $timeSlothtml .= sprintf('<input type="button" %s value="%s">', $class, $timeslot['datetime']->format('H:i'));
        }
        
        if(empty($timeSlothtml)) {
            $timeSlothtml .= 'aucun rdv disponible pour ce jour';
        }
        return $timeSlothtml;
    }

    /**
     * Create a timeslot array for today
     * @param ConfigOpeningTime $configOpeningTime is the OpeningTime for the timeslots
     * @param DateInterval $duration is the timeslots duration
     */
    private function createTimeslots(ConfigOpeningTime $configOpeningTime, DateInterval $duration, DateTime $date = new DateTime("now")): array
    {
        $startDate = (clone $date)->setTime(0, 0);
        $endDate = (clone $date)->setTime(23, 30);
        $configOpeningTime =  $configOpeningTime->get();
        $OpeningTimeAMtoday = $configOpeningTime[strtolower($date->format('l'))]["AM"];
        $OpeningTimePMtoday = $configOpeningTime[strtolower($date->format('l'))]["PM"];
        $timeSlots = array();
        // Create for today
        for ($i = 0; $startDate->format('U') - $endDate->format('U') < 0; $startDate->add($duration)) {
            $strDate = $startDate->format('H:i');
            // If it's in the opening time
            
            if (!empty($OpeningTimeAMtoday) && $strDate >= $OpeningTimeAMtoday[0] && $strDate < $OpeningTimeAMtoday[1]) {
                $timeSlots[$i]["datetime"] = clone $startDate;
                $i++;
            }
            if(!empty($OpeningTimePMtoday) && $strDate >= $OpeningTimePMtoday[0] && $strDate < $OpeningTimePMtoday[1]) {
                $timeSlots[$i]["datetime"] = clone $startDate;
                $i++;
            }
        }
        
        return $timeSlots;
    }

    private function addOccupiedInfoToTimeslots(array &$timeslots, int $idDoctor, DateInterval $duration, DateTime $date = new DateTime("now")): array
    {
        $appointmentService = new AppointmentService();
        $appointments = $appointmentService->getAppointmentById_DoctorAndDate($idDoctor, $date);
        return $this->addInfoToTImeslots($timeslots, $duration, 'occupied', $appointments);
    }

    private function addOccupiedByUserInfoToTimeslots(array &$timeslots, int $idDoctor, DateInterval $duration, DateTime $date = new DateTime("now")): array
    {
        $appointmentService = new AppointmentService();
        $appointments = $appointmentService->getAppointmentById_UsersAndId_DoctorAndDate($_SESSION['auth']->getId_users(), $idDoctor, $date);
        return $this->addInfoToTImeslots($timeslots, $duration, 'made', $appointments);
    }

    private function addInfoToTImeslots(array &$timeslots, DateInterval $duration, string $info, array $appointments): array
    {
        for ($i = 0; $i < count($timeslots); $i++) {
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
