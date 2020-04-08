<?php

namespace Webserver\Enum;

/**
 * Class EnumChannel
 * @package Webserver\Entity
 */
final class EnumChannel
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
     * @var string
     */
    const ERROR = "randomValue";

    /**
     * EnumChannel constructor.
     */
    private function __construct(){}


    /**
     * @param $value
     * @return bool
     * @throws \Exception
     */
    public static function isValid($value)
    {
        if(!in_array($value, [self::FAQ, self::BOT, self::ERROR])) {
            throw  new \Exception("$value is not valid \n possible values ares: ".self::FAQ.", ". self::BOT.', '. self::ERROR);
        }
        return true;
    }
}