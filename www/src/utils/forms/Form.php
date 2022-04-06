<?php

namespace App\utils\forms;

require '../vendor/autoload.php';


use InvalidArgumentException;

/**
 * This class used to create and display a form
 */
class Form implements FormI
{
    private String $action;
    private String $method;
    private array $fields = [];
    private bool $isCompleted = false;

    /**
     * @param string $action is the attribute action of this form, default is empty
     * @param string $method is the attribute action of this form, default is POST
     */
    public function __construct(String $action = "", $method = "POST")
    {
        $this->action = $action;
        $this->method = $method;
    }


    public function addField(String $name, String $label = "", Tag $tag = Tag::Input, String $type = "text", String $content = "", array $params = [], array $validation = []): self
    {
        if (array_key_exists($name, $this->fields)) {
            throw new InvalidArgumentException("The field exist already : $name");
        }
        try {
            $this->fields[$name] = new Field($name, $tag, $type, $content, $params,  $validation, $label);
        } catch (InvalidArgumentException $e) {
            printf($e);
        }
        return $this;
    }

    /**
     * Add a field in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $type is the input typedefault is 'text'.
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addInput(string $name, $label = '', String $type = 'text', String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, $label, Tag::Input, $type, $content, $params, $validation);
        return $this;
    }

    /**
     * Add a textarea field in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addTextArea(string $name, $label = '',  String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, $label, Tag::TextArea, '', $content, $params, $validation);
        return $this;
    }

    /**
     * Add a input field of text type in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addInputText(string $name, $label = '', String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, $label, Tag::Input, 'text', $content, $params, $validation);
        return $this;
    }

    /**
     * Add a input field of submit type in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addInputSubmit(string $name, String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, '', Tag::Input, 'submit', $content, $params, $validation);
        return $this;
    }

    /**
     * Add a input field of password type in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addInputPassword(string $name, $label = '', String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, $label, Tag::Input, 'password', $content, $params, $validation);
        return $this;
    }

    /**
     * Add a input field of email type in the form
     * @param String $name is the field name.
     * @param String $label is the field label, default is empty, empty is no label
     * @param String $content is the value content for the unclosable elements, default is empty.
     * @param array $params is a array with the attribute name for key et the attribute value for value , default is empty.
     * @param array $validation is a array of ValidatorI to test the content, default is a empty array.
     * @return self
     */
    public function addInputEmail(string $name, $label = '', String $content = "", array $params = [], array $validation = []): self
    {
        $this->addField($name, $label, Tag::Input, 'email', $content, $params, $validation);
        return $this;
    }






    public function isValid(): bool
    {
        foreach ($this->fields as $field) {
            if (!$field->checkValidation()) {
                return false;
            }
        }
        return true;
    }

    public function fillOut(array $arr): self
    {
        foreach ($arr as $name => $value) {
            $this->fields[$name]->setValidationActivated(true);
            $this->fields[$name]->setContent($value);
        }
        $this->isCompleted = true;
        return $this;
    }

    public function clear(): self
    {
        foreach ($this->fields as $field) {
            $field->setValidationActivated(false);
            $field->setContent('');
        }
        $this->isCompleted = false;
        return $this;
    }

    private function toHTML(): string
    {
        $str = sprintf('<form action="%s" method="%s">', $this->action, $this->method);
        foreach ($this->fields as $field) {
            $str .= '<div class="form-field-group">';
            $str .= $field->toHTML();
            $str .= '</div>';
        }
        $str .= '</form>';
        return $str;
    }

    public function show(): void
    {
        echo $this->toHTML();
    }
}
