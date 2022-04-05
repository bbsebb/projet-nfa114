<?php

namespace App\utils;

use InvalidArgumentException;

require '../vendor/autoload.php';


class Field
{

    private String $name;
    private Tag $tag;
    private String $type;
    private String $containt;
    private array $validations;
    private array $params;

    public function __construct(String $name, Tag $tag, String $type, String $containt = "", $params = [], array $validations = [])
    {
        $this->name = $name;
        $this->tag = $tag;
        $this->type = $type;
        $this->containt = $containt;
        $this->validations = $validations;
        $this->params = $params;
        foreach ($this->validations as $validation) {
            if(is_a($validation,ValidatorI::class)) {
                throw new InvalidArgumentException();         
            }
            $validation->setFieldToValidate($this->containt);
        }
    }


    public function toHTML(): string
    {
        $htmlParams = "";
        foreach ($this->params as $param => $value) {
            $htmlParams .= " $param=\"$value\" ";
        }
        if ($this->tag->isClosable()) {
            return sprintf('<%s name="%s" ' . $htmlParams . '> %s </%s>', $this->tag->value, $this->name, $this->containt, $this->tag->value);
        } else {
            return sprintf('<%s name="%s" value="%s" ' . $htmlParams . '/>', $this->tag->value, $this->name, $this->containt, $this->tag->value);
        }
    }

    public function checkValidation(): bool
    {
        $rtr = true;
        foreach ($this->validations as $validation) {
            
            $rtr = $rtr && $validation->isValid();
        }
        
        return $rtr;
    }

    public function getContaint(): String
    {
        return $this->containt;
    }

    public function setContaint(String $containt)
    {
        $this->containt = $containt;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function addParam(String $param, String $value)
    {
        $this->params[$param] = $value;
    }

    public function setValidation(callable $validation)
    {
        $this->validation = $validation;
    }

    public function getMessageErrors(): array
    {
        $rtr = [];
        foreach ($this->validations as $validation) {
            $rtr[] = $validation->getMessageError();
        }
        return $rtr;
    }
}
