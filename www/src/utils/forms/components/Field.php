<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;

/**
 * This class is a div with a label, a input and a span with the error message
 */
class Field extends Form{

    static private string $tag = "div";

    
    private array $attributes;
    private Label $label;  
    private Input $input; 
    private SpanError $spanError; 
    

    /**
     * @param Label $label is the label contained in this class
     * @param Input $input is the input contained in this class
     * @param SpanError $spanError is the span with the error message contained in this class
     * @param array $attributes is the field tag attributes 
     */
    public function __construct(Label $label,Input $input,SpanError $spanError,array $attributes = ["class"=>"form-field-group"])
    {

        $this->attributes = $attributes;
        $this->label = $label;
        $this->input = $input;
        $this->spanError = $spanError;

        
    }

    

    /**
     * Get the value of label
     */ 
    public function getLabel():Label
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label):self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of input
     */ 
    public function getInput(): Input
    {
        return $this->input;
    }

    /**
     * Set the value of input
     *
     * @return  self
     */ 
    public function setInput($input): self
    {
        $this->input = $input;

        return $this;
    }

    /**
     * Get the value of spanError
     */ 
    public function getSpanError(): SpanError
    {
        return $this->spanError;
    }

    /**
     * Set the value of spanError
     *
     * @return  self
     */ 
    public function setSpanError($spanError):self
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

    
}