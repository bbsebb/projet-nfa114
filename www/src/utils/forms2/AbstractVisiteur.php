<?php

namespace App\utils\forms2;

abstract class AbstractVisiteur {

    abstract public function visiteForm(Form $form) ;
    abstract public function visiteField(Field $field);
    abstract public function visiteLabel(Label $label);
    abstract public function visiteInput(Input $input);
    abstract public function visiteSpanError(SpanError $span);
    abstract public function visiteSubmit(Submit $submit);

}