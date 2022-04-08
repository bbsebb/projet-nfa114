<?php

namespace App\utils\forms2;

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
