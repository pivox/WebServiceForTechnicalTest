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
        if (isset($argv[1])) {
            $this->title = str_replace("title=","", $argv[1]);
        } else {
            throw new \Exception("you have to pass title in parametre");
        }
    }


    /**
     * @throws \Exception
     */
    public function init()
    {
        $channelBot = EnumChannel::bot();
        $status = EnumQuestionStatus::published();

        $answer = new Answer($channelBot, "test body");
        $this->question = new Question();
        $this->question->setTitle($this->title)
            ->setStatus($status)
            ->setPromoted(true)
            ->addAnswer($answer);
    }

    /**
     * @return false|string
     */
    public function getJsonForSend()
    {
        return json_encode($this->question);
    }
}