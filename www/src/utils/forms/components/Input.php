<?php

namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;

/**
 * This class is a input with a validations array to check the value.
 */
class Input extends Field
{

    static private string $tag = "input";
    private string $name;
    private array $attributes;
    private string $value;
    private array  $validations;
    private bool $fillOut;
    private string $type;


    /**
     * @param string $name is the input name.
     * @param string $value is the input value
     * @param string $type is the input type
     * @param array $validations is a array of ValidatorI.
     * @param array $attributes is the field tag attributes 
     */
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
    public function getValue():string
    {
        return $this->value;
    }

    /**
     * Set the value of value and switch the var fillOut on true
     *
     * @return  self
     */
    public function setValue($value):self
    {
        $this->fillOut = true;
        $this->value = $value;
        return $this;
    }

    /**
     * clear the value and witch the var fillOut on false
     */
    public function clear():void {
        $this->fillOut = false;
        $this->value = "";
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

    public function  accept(AbstractVisiteur $visiteur): mixed
    {
        return $visiteur->visiteInput($this);
    }

    /**
     * Get the value of validations
     */
    public function getValidations():array
    {
        return $this->validations;
    }

    /**
     * Set the value of validations
     *
     * @return  self
     */
    public function setValidations($validations):self
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
    public function addValidations($validation):self
    {
        $this->validations[] = $validation;
        if ($this->isFillOut()) {
            $validation->setFieldToValidate($this->value);
        }
        return $this;
    }

    /**
     * @return bool true if the input is fillout.
     */ 
    public function isFillOut():bool
    {
        return $this->fillOut;
    }

    /**
     * Get the value of type
     */ 
    public function getType():string
    {
        return $this->type;
    }



        /**
     * Get the value of name
     */ 
    public function getName():string
    {
        return $this->name;
    }
}
