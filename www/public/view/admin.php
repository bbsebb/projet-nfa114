<h1>admin</h1>

<?php

use App\repository\DoctorRepository;
use App\services\DoctorService;
use App\utils\forms\Form;
use App\utils\validators\ValidatorFactory;

require '../vendor/autoload.php';

$repo = new DoctorService();

dump($repo->getById(1));



?>