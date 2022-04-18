<?php

namespace App\utils\forms\components;

use App\utils\forms\visitors\AbstractVisiteur;

class Select extends Form
{
    static private string $tag = "select";
    private array $attributes;
    private string $name;
    private array $childs;

    /**
     * @param string $value is the label value; default envoyer
     * @param array $attributes is the field tag attributes 
     */
    public function __construct($name,$childs = [],$attributes = [])
    {
        $this->attributes = $attributes;
        $this->name = $name;
        $this->childs = $childs;
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
    public function getName()
    {
        return $this->name;
    }

        /**
     * @param AbstractForm $child is a leaf or composite child
     * @return self
     */
    public function addChild(AbstractForm $child): self
    {
        $this->childs[] = $child;
        return $this;
    }


    /**
     * @return array of childs
     */
    public function getChilds(): array
    {
        return $this->childs;
    }


    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteSelect($this);
    }
}
