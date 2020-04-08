<?php

namespace Webserver\Enum;

/**
 * Class Enum
 * @package Webserver\Entity
 */
class Enum
{
    /**
     * @var string
     */
    protected $val;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->val;
    }
}