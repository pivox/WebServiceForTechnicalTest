<?php

namespace Webserver\Entity;

use Webserver\Enum\EnumChannel;

/**
 * Class Answer
 * @package Webserver\Entity
 */
class Answer implements \JsonSerializable, ResolvableInterface
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
    */
    private $channel;

    /**
     * @var string
    */
    private $body;

    /**
     * Answer constructor.
     * @param integer $id
     * @param string $EnumChannel
     * @param string $body
     */
    public function __construct(int $id, string $EnumChannel = null, string $body = null)
    {
        $this->id = $id;
        $this->channel = $EnumChannel;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Answer
     */
    public function setId(int $id): Answer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     * @return Answer
     */
    public function setChannel(string $channel): Answer
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Answer
     */
    public function setBody(string $body): Answer
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnumChannel(): string
    {
        return $this->channel;
    }

    /**
     * @param string $EnumChannel
     * @return Answer
     */
    public function setEnumChannel(string $EnumChannel): Answer
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
            "id" => $this->id,
        ];
    }

    /**
     * @inheritDoc
     */
    public function resolve(array $array): ResolvableInterface
    {
        $pattern = '/channel(_){0,1}([\d])*/m';

        foreach ($array as $key => $value) {
            switch ($key){
                case "channel_".$this->id:
                    if(EnumChannel::isValid($value)) {
                        $this->setEnumChannel($value);
                    }
                //TODO
            }
        }
        return $this;
    }
}