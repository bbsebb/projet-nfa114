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
 * This class is a implementation of a algorithm who return the html representation of a form
 */
class VisiteurToHTML extends AbstractVisiteur
{
    private bool $isShowError;

    public function __construct($isShowError = false)
    {
        $this->isShowError =  $isShowError;
    }

    public function visiteForm(Form $form): string
    {
        $str = "<form {$this->attributesToHTML($form->getAttributes())}>";
        foreach ($form->getChilds() as $childs) {
            $str .= $childs->accept($this);
        }
        $str .= '</form>';
        return $str;
    }
    public function visiteField(Field $field): string
    {
        $str = "";
        $str .= "<div {$this->attributesToHTML($field->getAttributes())}>";
        $str .= $field->getLabel()->accept($this);
        $str .= $field->getForm()->accept($this);
        if ($field->getForm() instanceof Input) {
            $input =  $field->getForm();
            if (!$this->checkValidation($input->getValue(), $input->getValidations()) && $input->IsFillOut() && $this->isShowError) {
                $field->getSpanError()->setMessageError($this->getMessageErrors($input->getValidations()));
                $str .= $field->getSpanError()->accept($this);
            }
        }
        $str .= '</div>';
        return $str;
    }
    public function visiteLabel(Label $label): string
    {
        return "<label>{$label->getText()}</label>";
    }
    public function visiteInput(Input $input): string
    {
        if (!$this->checkValidation($input->getValue(), $input->getValidations()) && $input->IsFillOut() && $this->isShowError) {
            $input->addAttributes("class", "input-error");
        }
        return sprintf('<input type="%s" name="%s" value="%s" %s>', $input->getType(), $input->getName(), $input->getValue(), $this->attributesToHTML($input->getAttributes()));
    }
    public function visiteSpanError(SpanError $span): string
    {
        $messageError = "";
        foreach ($span->getMessageError() as $value) {
            $messageError .= $value . " | ";
        }
        return "<span class=\"error\">$messageError</span>";
    }

    public function visiteSubmit(Submit $submit): string
    {
        return sprintf('<input type="%s" value="%s">', $submit::$type, $submit->getValue());
    }

    public function visiteSelect(Select $select): string
    {
        $str = sprintf('<select name="%s">', $select->getName());
        foreach ($select->getChilds() as $childs) {
            $str .= $childs->accept($this);
        }
        $str .= '</select>';
        return $str;
    }

    public function visiteOption(Option $option): string
    {
        return sprintf('<option value="%s">%s</option>', $option->getValue(), $option->getText());
    }



    private function attributesToHTML(array $attributes): string
    {
        $str = "";
        foreach ($attributes as $attribute => $value) {
            $str .= " $attribute=\"$value\" ";
        }
        return $str;
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
    private function getMessageErrors(array $validations): array
    {
        $rtr = [];
        foreach ($validations as $validation) {
            if (!$validation->isValid()) {
                $rtr[] = $validation->getMessageError();
            }
        }
        return $rtr;
    }
}
