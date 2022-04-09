<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;

/**
 * This class is a label 
 */
class Label extends Field
{

    static private string $tag = "label";


    private array $attributes;
    private string $text;

    /**
     * @param string $text is the label text
     * @param array $attributes is the field tag attributes 
     */
    public function __construct(string $text, $attributes = [])
    {
        $this->text = $text;
        $this->attributes = $attributes;
        $this->text = $text;
    }

    /**
     * Get the text of text
     */
    public function gettext():string
    {
        return $this->text;
    }

    /**
     * Set the text of text
     *
     * @return  self
     */
    public function settext($text):self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the text of attributes
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

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteLabel($this);
    }
}
