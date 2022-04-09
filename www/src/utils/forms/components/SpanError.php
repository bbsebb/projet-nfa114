<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;
use Exception;


/**
 * This class is a span with message error
 */
class SpanError extends Field
{

    static private string $tag = "span";

    private array $messageError;
    private array $attributes;


    /**
     * @param array $attributes is the field tag attributes 
     */
    public function __construct($attributes = [])
    {

        $this->attributes = $attributes;
    }

    /**
     * Get the value of attributes
     */
    public function getAttributes():array
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
    public function getMessageError():array
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
