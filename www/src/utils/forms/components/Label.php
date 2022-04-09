<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;
use Exception;

class Label extends Field
{

    static private string $tag = "label";


    private array $attributes;
    private string $value;

    public function __construct(string $value, $attributes = [])
    {
        $this->value = $value;
        $this->attributes = $attributes;
        $this->value = $value;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
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

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteLabel($this);
    }
}
