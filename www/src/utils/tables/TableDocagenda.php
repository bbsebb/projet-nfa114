<?php

namespace App\utils\tables;



class TableDocagenda extends Table
{
    public function __construct(array $appointments,$edit = false,$del = false)
    {
        $meta = ['Date','Heure','Patient'];
        if($edit) {
            $meta[] = 'Mod.';
        }
        if($del) {
            $meta[] = 'Supp.';
        }
        $tab= [];
        $i = 0;
        foreach ($appointments as $appointment) {
            $tab[$i][] = $appointment->getDatetime_start()->format("d/m/Y");
            $tab[$i][] = $appointment->getDatetime_start()->format("H:i");
            $tab[$i][] = $appointment->getUser()->getName();
            if($edit) {
                
            }
            if($del) {
                $tab[$i][] = '<a class="btn btn-primary" href="/myappointment/del/'.$appointment->getId_appointment().'" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>
                </a>';
            }
            $i++;
        }
        parent::__construct($tab,$meta);
    }
}