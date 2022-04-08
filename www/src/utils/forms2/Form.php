<?php

namespace App\utils\forms2;

use Exception;

class Form extends AbstractForm{

    static private string $tag = "form";
    private array $attributes;
    private array $childs;  
    

    public function __construct(array $forms = [],$attributes = [])
    { 
        $this->attributes = $attributes;
        $this->childs = $forms;
    }

    public function  accept(AbstractVisiteur $visiteur):mixed {
        return $visiteur->visiteForm($this);
    }


    public function addChild(AbstractForm $form):self {
        $this->childs[] = $form;
        return $this;
    }

    public function getChilds():array {
        return $this->childs;
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