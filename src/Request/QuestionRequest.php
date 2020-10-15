<?php

declare(strict_types=1);

namespace Webserver\Request;

use Webserver\Config\Config;
use Webserver\Curl;

class QuestionRequest
{

    /** @var Curl */
    private $curl;

    public function getAll()
    {
        $this->curl = new Curl(Config::getQuestionsUrl());
        return json_decode($this->curl->get(), true);
    }

    public function getById(int $id)
    {
        $this->curl = new Curl(Config::getQuestionUrl($id));
        return json_decode($this->curl->get(), true);
    }

    public function editQuestion(int $id, string $json)
    {
        $this->curl = new Curl(Config::getQuestionUrl($id));
        return json_decode($this->curl->put($json), true);
    }
}