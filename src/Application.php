<?php

namespace Webserver;

use Webserver\Entity\Answer;
use Webserver\Enum\EnumChannel;
use Webserver\Enum\EnumQuestionStatus;
use Webserver\Entity\Question;

/**
 * Class Application
 * @package Webserver
 */
class Application
{
    /**
     * @var Question
     */
    private $question;

    /**
     * @var ArgsResolver
     */
    private $resolver;

    /**
     * Application constructor.
     * @param array $argv
     * @throws \Exception
     */
    public function __construct(array $argv)
    {
        if (count($argv)> 0) {
            unset($argv[0]);
            $this->resolver = new ArgsResolver(array_values($argv));
        } else {
            throw new \Exception("you have to pass some parametres");
        }
    }


    /**
     * @throws \Exception
     */
    public function init()
    {
        //preparing test data and
        $channelBot = EnumChannel::BOT;
        $status = EnumQuestionStatus::PUBLISHED;

        $answer = new Answer(1, $channelBot, "test body");
        $answer = $this->resolver->setResovableObject($answer)->resolveParams();
        $this->question = new Question();
        $this->question->setId(1)
            ->setTitle('toto')
            ->setStatus($status)
            ->setUpdated(new \DateTime())
            ->setPromoted(true)
            ->addAnswer($answer)
;
        $this->question = $this->resolver->setResovableObject($this->question)->resolveParams();
    }

    /**
     * @return false|string
     */
    public function getJsonForSend()
    {
        return json_encode($this->question);
    }
}