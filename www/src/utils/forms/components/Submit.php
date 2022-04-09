<?php

namespace App\utils\forms\components;

use App\utils\forms\visitors\AbstractVisiteur;

class Submit extends Field
{
    static private string $tag = "input";
    static public string $type = "submit";
    private array $attributes;
    private string $value;

    /**
     * @param string $value is the label value; default envoyer
     * @param array $attributes is the field tag attributes 
     */
    public function __construct($value= "Envoyer",$attributes = [])
    {
        $this->attributes = $attributes;
        $this->value = $value;
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
    public function addAttributes($attribute, $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Get the value of value
     */ 
    public function getValue():string
    {
        return $this->value;
    }


    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteSubmit($this);
    }
}
