<?php

namespace Webserver\Enum;

/**
 * Class EnumChannel
 * @package Webserver\Entity
 */
final class EnumChannel extends Enum
{
    /**
     * @var string
     */
    const FAQ = "faq";
    /**
     * @var string
     */
    const BOT = "bot";

    /**
     * EnumChannel constructor.
     * @param $val
     * @throws \Exception
     */
    private function __construct($val) {
        if (!in_array($val, [self::BOT, self::FAQ])){
            throw new \Exception("The value $val is not in the enum");
        }
        $this->val = $val;
    }

    /**
     * @param $value
     * @param array $arguments
     * @return EnumChannel
     * @throws \Exception
     */
    public static function __callStatic($value, $arguments = [])
    {
        return new self($value);
    }
}