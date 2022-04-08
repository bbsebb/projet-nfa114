<?php

namespace App\utils\forms2;

use Exception;

class SpanError extends Field
{

    static private string $tag = "span";

    private array $messageError;
    private array $attributes;


    public function __construct($attributes = [])
    {

        $this->attributes = $attributes;
    }

    /**
     * Get the value of attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

/**
     * add a attribute
     *
     * @return  self
     */
    public function addAttributes($attribute,$value):self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Get the value of messageError
     */
    public function getMessageError()
    {
        return $this->messageError;
    }

    /**
     * Set the value of messageError
     *
     * @return  self
     */
    public function setMessageError($messageError):self
    {
        $this->messageError = $messageError;

        return $this;
    }

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteSpanError($this);
    }
}
