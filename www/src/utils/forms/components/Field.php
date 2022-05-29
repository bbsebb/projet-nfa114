<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;

/**
 * This class is a div with a label, a form and a span with the error message
 */
class Field extends Form{

    static private string $tag = "div";

    
    private array $attributes;
    private Label $label;  
    private Form $form; 
    private SpanError $spanError; 
    

    /**
     * @param Label $label is the label contained in this class
     * @param Form $form is the form contained in this class
     * @param SpanError $spanError is the span with the error message contained in this class
     * @param array $attributes is the field tag attributes 
     */
    public function __construct(Label $label,Form $form,SpanError $spanError,array $attributes = ["class"=>"form-field-group"])
    {

        $this->attributes = $attributes;
        $this->label = $label;
        $this->form = $form;
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
     * Get the value of form
     */ 
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * Set the value of form
     *
     * @return  self
     */ 
    public function setForm($form): self
    {
        $this->form = $form;

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