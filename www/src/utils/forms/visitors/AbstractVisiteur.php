<?php

namespace App\utils\forms\visitors;

use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\SpanError;
use App\utils\forms\components\Submit;

abstract class AbstractVisiteur {

    abstract public function visiteForm(Form $form) ;
    abstract public function visiteField(Field $field);
    abstract public function visiteLabel(Label $label);
    abstract public function visiteInput(Input $input);
    abstract public function visiteSpanError(SpanError $span);
    abstract public function visiteSubmit(Submit $submit);

}