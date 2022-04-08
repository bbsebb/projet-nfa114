<?php

namespace App\utils\forms2;

use Exception;

class Field extends Form{

    static private string $tag = "div";

    
    private array $attributes;
    private Label $label;  
    private Input $input; 
    private SpanError $spanError; 
    

    public function __construct(Label $label,Input $input,SpanError $spanError,$attributes = ["class"=>"form-field-group"])
    {

        $this->attributes = $attributes;
        $this->label = $label;
        $this->input = $input;
        $this->spanError = $spanError;

        
    }

    

    /**
     * Get the value of label
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of input
     */ 
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the value of input
     *
     * @return  self
     */ 
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get the value of spanError
     */ 
    public function getSpanError()
    {
        return $this->spanError;
    }

    /**
     * Set the value of spanError
     *
     * @return  self
     */ 
    public function setSpanError($spanError)
    {
        $this->spanError = $spanError;

        return $this;
    }

    public function  accept(AbstractVisiteur $visiteur):mixed {
        return $visiteur->visiteField($this);
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

    
}