<?php

namespace App\utils\forms2;

class VisiteurIsValid extends AbstractVisiteur
{

    public function visiteForm(Form $form): bool
    {
        $flag = true;
        foreach ($form->getChilds() as $childs) {
            $flag = $flag && $childs->accept($this);
        }
        return $flag;
    }
    public function visiteField(Field $field): bool
    {
        return $field->getInput()->accept($this);
    }
    public function visiteLabel(Label $label): bool
    {
        return true;
    }
    public function visiteInput(Input $input): bool
    {
        return $this->checkValidation($input->getValue(), $input->getValidations());
    }
    public function visiteSpanError(SpanError $span): bool
    {
        return true;
    }
    public function visiteSubmit(Submit $submit): bool
    {
        return true;
    }

    /**
     * @return bool true if all validations checked true otherwise false
     */
    private function checkValidation(string $strToCheck, array $validations): bool
    {
        $rtr = true;
        foreach ($validations as $validation) {
            $validation->setFieldToValidate($strToCheck);
            $rtr = $rtr && $validation->isValid();
        }
        return $rtr;
    }
}
