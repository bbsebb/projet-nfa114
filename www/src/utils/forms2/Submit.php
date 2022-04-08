<?php

namespace App\utils\forms2;

class Submit extends Field
{
    static private string $tag = "input";
    static public string $type = "submit";
    private array $attributes;
    private string $value;

    public function __construct($value= "Envoyer",$attributes = [])
    {
        $this->attributes = $attributes;
        $this->value = $value;
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
    public function addAttributes($attribute, $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Get the value of value
     */ 
    public function getValue()
    {
        return $this->value;
    }


    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteSubmit($this);
    }
}
