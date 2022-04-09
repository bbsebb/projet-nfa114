<?php

namespace App\utils\forms;

use App\utils\validators\ValidatorI;
use InvalidArgumentException;

require '../vendor/autoload.php';




/**
 * This class is a field of Form.
 */
class Field
{

    private String $name;
    private Tag $tag;
    private String $type;
    private String $content;
    private array $validations;
    private array $params;
    private String $label;
    /**
     * @var is the variable that enables error display
     */
    private bool $validationActivated = false;

    /**
     * Create a field 
     * @param String $name is the field name.
     * @param Tag $tag is the field's tag, default is 'input'.
     * @param String $type is the input typedefault is 'text'.
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @param String $label is the field label, default is empty, empty is no label
     * @return self
     */
    public function __construct(String $name, Tag $tag, String $type, String $content = "", $params = [], array $validations = [],$label = "")
    {
        $this->name = $name;
        $this->tag = $tag;
        $this->type = $type;
        $this->content = $content;
        $this->validations = $validations;
        $this->params = $params;
        $this->label = $label;
        foreach ($this->validations as $validation) {
            if(!is_a($validation,ValidatorI::class)) {
                throw new InvalidArgumentException("The validator must implement ValidatorI");         
            }
        }
    }

    public function getContent(): String
    {
        return $this->content;
    }

    public function setContent(String $content):void
    {
        $this->content = $content;
    }

    public function setParams(array $params):void
    {
        $this->params = $params;
    }

    public function addParam(String $param, String $value):void
    {
        $this->params[$param] = $value;
    }

    public function setValidation(callable $validation):void
    {
        $this->validation = $validation;
    }

    public function setValidationActivated(bool $validationActivated):void
    {
        $this->validationActivated = $validationActivated;
    }

    public function setLabel(callable $label):void
    {
        $this->label = $label;
    }

    /**
     * @return string is a field in HTML format with label if label is no empty and span error if checkValidation is true  
     */
    public function toHTML(): string
    {
        $html = "";
        if(!empty($this->label)) {
            $html .= sprintf('<label for="%s"> %s </label>', $this->name, $this->label);
        }
        $htmlParams = "";
        foreach ($this->params as $param => $value) {
            $htmlParams .= " $param=\"$value\" ";
        }
        if(!$this->checkValidation() && $this->validationActivated) {
            $htmlParams .= ' class="input-error "';
        }
        if ($this->tag->isClosable()) {
            $html .= sprintf('<%s type="%s" name="%s" ' . $htmlParams . '> %s </%s>',$this->tag->value,$this->type,  $this->name, $this->content, $this->tag->value);
        } else {
            $html .= sprintf('<%s type="%s" name="%s" value="%s" ' . $htmlParams . '>',$this->tag->value, $this->type, $this->name, $this->content);
        }
        if(!$this->checkValidation() && $this->validationActivated) {
            $html .= sprintf('<span class="error">%s</span>', implode("<br>",$this->getMessageErrors()));
        }
        return $html;
    }

    private function getMessageErrors(): array
    {
        $rtr = [];
        foreach ($this->validations as $validation) {
            $rtr[] = $validation->getMessageError();
        }
        return $rtr;
    }

    /**
     * @return bool true if all validations checked true otherwise false
     */
    public function checkValidation(): bool
    {
        $rtr = true;
        foreach ($this->validations as $validation) { 
            $validation->setFieldToValidate($this->content);      
            $rtr = $rtr && $validation->isValid();
        }
        
        return $rtr;
    }

    
}
