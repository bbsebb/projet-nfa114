<?php
namespace App\utils;
require '../vendor/autoload.php';
enum Tag: string
{
    case Input = "input";
    case TextArea = "textarea";

    public function isClosable(): bool {
        return match($this) {
            static::Input => false,
            static::TextArea => true,
        };
    }
}