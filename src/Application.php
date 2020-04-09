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
     * @var String
     */
    private $title;

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
        $channelBot = EnumChannel::BOT;
        $status = EnumQuestionStatus::PUBLISHED;

        $answer = new Answer(1, $channelBot, "test body");
        $this->question = new Question();
        $this->question->setId(1)
            ->setTitle('toto')
            ->setStatus($status)
            ->setPromoted(true)
            ->addAnswer($answer)
;
        $answer = $this->resolver->setResovableObject($answer)->resolveParams();
        $this->question = $this->resolver->setResovableObject($this->question)->resolveParams();
//        print_r($this->question);
    }

    /**
     * @return false|string
     */
    public function getJsonForSend()
    {
        return json_encode($this->question);
    }
}