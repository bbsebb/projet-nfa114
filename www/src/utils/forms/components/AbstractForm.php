<?php
namespace App\utils\forms\components;
use App\utils\forms\visitors\AbstractVisiteur;
abstract class AbstractForm {

    abstract public function accept(AbstractVisiteur $visiteur):mixed;

    /**
     * add a attribute
     *
     * @return  self
     */
    abstract public function addAttributes($attribute,$value):self;

}