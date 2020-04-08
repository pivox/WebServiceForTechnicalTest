<?php

namespace Webserver;

use Webserver\Entity\ResolvableInterface;

/**
 * Class ArgsResolver
 * @package Webserver
 */
class ArgsResolver
{
    /** @var array */
    private $args;

    /** @var ResolvableInterface */
    private $resolvableObject;

    /**
     * ArgsResolver constructor.
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->args = [];
        foreach ($args as $argument) {
            $myVars = explode("=", $argument);
            $this->args[$myVars[0]] = $myVars[1];
        }

    }

    /**
     * @return ResolvableInterface
     */
    public function getResovableObject(): ResolvableInterface
    {
        return $this->resolvableObject;
    }

    /**
     * @param ResolvableInterface $resolvableObject
     * @return ArgsResolver
     */
    public function setResovableObject(ResolvableInterface $resolvableObject): ArgsResolver
    {
        $this->resolvableObject = $resolvableObject;
        return $this;
    }

    /**
     *
     */
    public function resolveParams(): ResolvableInterface
    {
        return $this->resolvableObject->resolve($this->args);
    }
}