<?php

namespace App\utils\forms\visitors;

use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\Option;
use App\utils\forms\components\Select;
use App\utils\forms\components\SpanError;
use App\utils\forms\components\Submit;

/**
 * This abstract class declares a set of visiting methods that correspond to element classes. The signature of a visiting method lets the visitor identify the exact class of the element that it's dealing with.
 */
abstract class AbstractVisiteur {

    /**
     * This method is the several versions of a algorithm
    * @param Form $form is the instance who call visite method 
    */
    abstract public function visiteForm(Form $form) ;
        /**
     * This method is the several versions of a algorithm
    * @param Field $field is the instance who call visite method 
    */
    abstract public function visiteField(Field $field);
        /**
     * This method is the several versions of a algorithm
    * @param Label $label is the instance who call visite method 
    */
    abstract public function visiteLabel(Label $label);
        /**
     * This method is the several versions of a algorithm
    * @param Input $input is the instance who call visite method 
    */
    abstract public function visiteInput(Input $input);
        /**
     * This method is the several versions of a algorithm
    * @param SpanError $span is the instance who call visite method 
    */
    abstract public function visiteSpanError(SpanError $span);
        /**
     * This method is the several versions of a algorithm
    * @param Submit $submit is the instance who call visite method 
    */
    abstract public function visiteSubmit(Submit $submit);
            /**
     * This method is the several versions of a algorithm
    * @param Submit $option is the instance who call visite method 
    */
    abstract public function visiteOption(Option $option);
            /**
     * This method is the several versions of a algorithm
    * @param Submit $select is the instance who call visite method 
    */
    abstract public function visiteSelect(Select $select);

}