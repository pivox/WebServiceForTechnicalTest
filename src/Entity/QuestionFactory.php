<?php

declare(strict_types=1);

namespace Webserver\Entity;

/**
 * Generate quesion object from json
*/
class QuestionFactory
{
    /**
     * QuestionFactory constructor.
     */
    private function __construct() {}

    public static function getQuestion(array $array)
    {
        $question = new Question();
        $question->setId($array['id'])
            ->setTitle($array['title'])
            ->setPromoted($array['promoted'])
            ->setStatus($array['status'])
            ;
        $answers = new \ArrayObject();
        foreach ($array['answers'] as $answerData) {
            $answer = new Answer($answerData['id'], $question->getId(), $answerData['channel'], $answerData['body']);
            $answers->append($answer);
        }
        $question->setAnswers($answers);

        return $question;
    }

}