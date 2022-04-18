<?php

namespace App\utils\forms\components;

use App\utils\forms\visitors\AbstractVisiteur;

class Option extends Form
{
    static private string $tag = "select";
    private array $attributes;
    private string $value;
    private string $text;

    /**
     * @param string $value is the label value; default envoyer
     * @param array $attributes is the field tag attributes 
     */
    public function __construct($text,$value = "",$attributes = [])
    {
        $this->attributes = $attributes;
        $this->value = $value;
        $this->text = $text;
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
    /**
     * Get the value of text
     */ 
    public function getText():string
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }



    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteOption($this);
    }


}
