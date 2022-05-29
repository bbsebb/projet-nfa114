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
 * This class is a implementation of a algorithm who fill out a form object with a array "name"=>"value"
 */
class VisiteurFillOut extends AbstractVisiteur
{
    private array $args;
    /**
     * @param array $args is a array with string keys "name" who are the input name of form and with string values who are the input value
     */
    public function __construct(array $args)
    {
        $this->args = $args;
    }
    public function visiteForm(Form $form): void
    {
        foreach ($form->getChilds() as $childs) {
            $childs->accept($this);
        }
    }
    public function visiteField(Field $field): void
    {
         $field->getForm()->accept($this);
    }
    public function visiteLabel(Label $label): void
    {
        
    }
    public function visiteInput(Input $input): void
    {
        if(array_key_exists($input->getName(),$this->args))
         $input->setValue($this->args[$input->getName()]);
    }
    public function visiteSpanError(SpanError $span): void
    {
        
    }
    public function visiteSubmit(Submit $submit): void
    {
        
    }
    public function visiteSelect(Select $select): void
    {
  
    }
    public function visiteOption(Option $option): void
    {
  
    }


    
}
