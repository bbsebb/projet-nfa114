<?php
namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;
abstract class AbstractForm {

    /**
     * @param AbstractVisiteur $visitor is the visitor who call the proper visitor’s method corresponding to the current element class
     */
    abstract public function accept(AbstractVisiteur $visitor):mixed;

    /**
     * add a attribute
     *
     * @return  self
     */
    abstract public function addAttributes($attribute,$value):self;

}