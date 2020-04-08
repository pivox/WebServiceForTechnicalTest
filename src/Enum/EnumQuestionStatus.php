<?php

namespace Webserver\Enum;

use http\Exception;

/**
 * Class EnumQuestionStatus
 * @package Webserver\Entity
 */
final class EnumQuestionStatus
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
        if(!in_array($value, [self::PUBLISHED, self::DRAFT, self::ERROR])) {
            throw  new \Exception("$value is not valid \n possible values ares: ".self::PUBLISHED.", ". self::DRAFT.', '. self::ERROR);
        }
        return true;
    }

    public static function getList(): array
    {
        return [
            self::DRAFT,
            self::PUBLISHED,
        ];
    }
}