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
     * @var integer
    */
    private $questionId;

    /**
     * Answer constructor.
     * @param integer $id
     * @param string $EnumChannel
     * @param string $body
     */
    public function __construct(int $id, int $questionId,string $EnumChannel = null, string $body = null)
    {
        $this->id = $id;
        $this->questionId = $questionId;
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
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "channel" => $this->channel,
            "body" => $this->body,
            "id" => $this->id,
            "question" => $this->questionId,
        ];
    }
}