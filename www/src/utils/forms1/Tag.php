<?php
namespace App\utils\forms;

/**
 * The tag list 
 */
enum Tag: string
{
    case Input = "input";
    case TextArea = "textarea";
    case Button = "button";

    /**
     * @return bool if the tag is closable or no.
     */
    public function isClosable(): bool {
        return match($this) {
            static::Input => false,
            static::TextArea => true,
            static::Button => true,
        };
    }
}