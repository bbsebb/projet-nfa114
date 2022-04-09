<?php

namespace App\utils\forms\visitors;

use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\SpanError;
use App\utils\forms\components\Submit;
class VisiteurFillOut extends AbstractVisiteur
{
    private array $args;
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
         $field->getInput()->accept($this);
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

    
}
