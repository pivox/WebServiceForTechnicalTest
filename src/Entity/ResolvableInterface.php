<?php

namespace Webserver\Entity;

interface ResolvableInterface
{
    /**
     * @param array $array
     * @return mixed
     */
    public function resolve(array $array): ResolvableInterface;
}