<?php

namespace Webserver\Entity;

use Webserver\Enum\EnumChannel;

/**
 * Class Answer
 * @package Webserver\Entity
 */
class Answer implements \JsonSerializable
{
    /**
     * @var EnumChannel
    */
    private $channel;

    /**
     * @var string
    */
    private $body;

    /**
     * Answer constructor.
     * @param EnumChannel $EnumChannel
     * @param string $body
     */
    public function __construct(EnumChannel $EnumChannel = null, string $body = null)
    {
        $this->channel = $EnumChannel;
        $this->body = $body;
    }

    /**
     * @return EnumChannel
     */
    public function getEnumChannel(): EnumChannel
    {
        return $this->channel;
    }

    /**
     * @param EnumChannel $EnumChannel
     * @return Answer
     */
    public function setEnumChannel(EnumChannel $EnumChannel): Answer
    {
        $this->channel = $EnumChannel;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "channel" => $this->channel,
            "body" => $this->body,
        ];
    }
}