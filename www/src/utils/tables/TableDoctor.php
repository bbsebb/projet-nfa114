<?php

namespace App\utils\tables;

use App\models\Doctor;

class TableDoctor extends Table
{
    public function __construct(array $doctors,$set = false,$del = false)
    {
        $meta = ['ID','Nom','Prénom','Email'];
        if($set) {
            $meta[] = 'Mod.';
        }
        if($del) {
            $meta[] = 'Supp.';
        }
        $tab= [];
        $i = 0;
        foreach ($doctors as $doctor) {
            $tab[$i][] = $doctor->getId_doctor();
            $tab[$i][] = $doctor->getName();
            $tab[$i][] = $doctor->getForname();
            $tab[$i][] = $doctor->getEmail();
            if($set) {
                $tab[$i][] = 'Mod.';
            }
            if($del) {
                $tab[$i][] = 'Supp.';
            }
            $i++;
        }
        parent::__construct($tab,$meta);
    }
}