<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;

/**
 * This class is a form with childs of leaf or composite
 */
class Form extends AbstractForm
{

    static private string $tag = "form";
    private array $attributes;
    private array $childs;


    /**
     * @param array $childs is a array of leaf or composite; must be AbstractForm. Default empty array.
     * @param array $attributes $attributes is the field tag attributes 
     */
    public function __construct(array $childs = [], $attributes = [])
    {
        $this->attributes = $attributes;
        $this->childs = $childs;
    }

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteForm($this);
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

    /**
     * Get the value of attributes
     * @return array 
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
}
