<?php

namespace App\utils;

require '../vendor/autoload.php';

use App\utils\Tag;
use InvalidArgumentException;

class Form implements FormI
{

    private array $fields = [];
    private array $fieldsName = [];
    private bool $isResponse = true;

    public function addField(String $name, Tag $tag, String $type, String $containt = "", array $params = [], array $verification = []): void
    {
        if (array_key_exists($name, $this->fields)) {
            throw new InvalidArgumentException("un champs correspond déjà à ce nom : $name");
        }
        try {
        $this->fields[$name] = new Field($name, $tag, $type, $containt, $params,  $verification);
        } catch(InvalidArgumentException $e) {
            
        }
    }

    public function toHTML(): string
    {
        $str = "";
        foreach ($this->fields as $field) {
            $str .= $field->toHTML() . '<br>';
            if (!$field->checkValidation() && $this->isResponse) {
                $str .= $this->errorToHTML($field->getMessageErrors());
            }
        }
        return $str;
    }

    public function errorToHTML($errorMessages): string
    {
        $str = '<span class="error">';
        foreach($errorMessages as $errorMessage) {
            $str .= $errorMessage . '<br>';
        }
        $str .= '</span>';
        return $str;
    }

    public function isValid(): bool
    {
        foreach ($this->fields as $field) {
            if (!$field->checkValidation()) {
                return false;
            }
        }
        return true;
    }

    public function show()
    {
        echo $this->toHTML();
    }
}
