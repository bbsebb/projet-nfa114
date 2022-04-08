<?php
namespace App\utils\forms2;

abstract class AbstractForm {

    abstract public function accept(AbstractVisiteur $visiteur):mixed;

    /**
     * add a attribute
     *
     * @return  self
     */
    abstract public function addAttributes($attribute,$value):self;

}