<?php

namespace App\utils\forms;

interface FormI {
    /**
     * Add a field in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param Tag $tag is the field's tag, default is 'input'.
     * @param String $type is the input typedefault is 'text'.
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addField(String $name, String $label = "", Tag $tag = Tag::Input, String $type = "text", String $content = "", array $params = [], array $validation = []): self;
    
       /**
     * @return bool true if all the fields are valide otherwise false
     */
    public function isValid(): bool;

    /**
     * 
     * @param array $arr is the array to fill out all fields of this form. 
     * @return self
     */
    public function fillOut(array $arr): self;

    /**
     * clear all fields of this form
     * @return self
     */
    public function clear(): self;

    /**
     * display form
     * @return void
     */
    public function show(): void;
}