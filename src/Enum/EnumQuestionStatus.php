<?php

namespace Webserver\Enum;

/**
 * Class EnumQuestionStatus
 * @package Webserver\Entity
 */
final class EnumQuestionStatus extends Enum
{
    /**
     * @var string
     */
    const DRAFT = "draft";
    /**
     * @var string
     */
    const PUBLISHED = "published";


    /**
     * EnumQuestionStatus constructor.
     * @param $val
     * @throws \Exception
     */
    private function __construct($val) {
        if (!in_array($val, [self::DRAFT, self::PUBLISHED])){
            throw new \Exception("The value $val is not in the enum");
        }
        $this->val = $val;
    }

    /**
     * @param $value
     * @param array $arguments
     * @return EnumQuestionStatus
     * @throws \Exception
     */
    public static function __callStatic($value, $arguments = [])
    {
        return new self($value);
    }
}