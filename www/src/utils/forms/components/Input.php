<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;
use Exception;

class Input extends Field
{

    static private string $tag = "input";
    private string $name;
    private array $attributes;
    private string $value;
    private array  $validations;
    private bool $fillOut;
    private string $type;


    public function __construct(string $name,string $value,string $type, array $validations, $attributes = [])
    {
        $this->attributes = $attributes;
        $this->fillOut = false;
        $this->value = $value;
        $this->validations = $validations;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->fillOut = true;
        $this->value = $value;
        return $this;
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

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteInput($this);
    }

    /**
     * Get the value of validations
     */
    public function getValidations()
    {
        return $this->validations;
    }

    /**
     * Set the value of validations
     *
     * @return  self
     */
    public function setValidations($validations)
    {
        $this->validations = $validations;

        if ($this->isFillOut) {
            foreach ($validations as $validation) {
                $validation->setFieldToValidate($this->value);
            }
        }
        return $this;
    }

    /**
     * Set the value of validations
     *
     * @return  self
     */
    public function addValidations($validation)
    {
        $this->validations[] = $validation;
        if ($this->isFillOut()) {
            $validation->setFieldToValidate($this->value);
        }
        return $this;
    }

    /**
     * Get the value of isFillOut
     */ 
    public function isFillOut():bool
    {
        return $this->fillOut;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }



        /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
}
