<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Webserver\Request\QuestionRequest;


/**
 * Features context.
 */
class FeatureContext  implements \Behat\Behat\Context\SnippetAcceptingContext
{
    /**  @var \Webserver\Entity\Question */
    private $question;

    /** @var array */
    private $params = ['main.php'];

    /** @var string */
    private $response;

    /**
     * @Given /^I a am a Question with id equals "([^"]*)"$/
     */
    public function iAAmAQuestionWithIdEquals($arg1)
    {
        if($arg1 != 1) {
            throw new PendingException( "Argument id must equal to one");
        }
        $answer = new \Webserver\Entity\Answer(1, 1, \Webserver\Enum\EnumChannel::BOT, "body toto");

        $this->question = new \Webserver\Entity\Question();
        $this->question = $this->question->setId($arg1)
            ->setPromoted(false)
            ->setTitle("title")
            ->addAnswer($answer)
        ;

    }

    /**
     * @Given /^Question have One answer with id equals "([^"]*)"$/
     */
    public function questionHaveOneAnswerWithIdEquals($arg1)
    {
        if ($this->question->getAnswers()->count() != 1) {
            throw new PendingException( "the Question must have one question");
        }
        \PHPUnit\Framework\Assert::assertCount(1, $this->question->getAnswers());
        \PHPUnit\Framework\Assert::assertEquals(1, $arg1);
        \PHPUnit\Framework\Assert::assertEquals($arg1, $this->question->getAnswers()->offsetGet(0)->getId());
        $answerId = $this->question->getAnswers()->offsetGet(0)->getId();
        if($answerId != $arg1 && $arg1 != 1) {
            throw new PendingException( "Argument id ans Answer must equal to one");
        }
    }

    /**
     * @Given /^Question title\'s to update with value "([^"]*)"$/
     */
    public function questionTitleSToUpdateWithValue($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals('behatValue', $arg1);
        $this->question->setTitle($arg1);
    }

    /**
     * @Given /^Question Status to update with value "([^"]*)"$/
     */
    public function questionStatusToUpdateWithValue($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals("draft", $arg1);
        $this->question->setStatus($arg1);
    }

    /**
     * @When /^I send the data$/
     */
    public function iSendTheData()
    {
        $questionRequest = new QuestionRequest();
        $this->response = $questionRequest->editQuestion((int) $this->question->getId(), json_encode($this->question));
    }

    /**
     * @Then I the response has field :arg1 with value :arg2
     */
    public function iTheResponseHasFieldWithValue2($arg1, $arg2)
    {
        $responseArray = $this->response;
        \PHPUnit\Framework\assertArrayHasKey($arg1, $responseArray, "$arg1 does not exist in response");
        if (array_key_exists($arg1, $responseArray)) {
            \PHPUnit\Framework\assertEquals($responseArray[$arg1], $arg2);
        }
    }

    /**
     * @Given request question with id :arg1
     */
    public function requestQuestionWithId($arg1)
    {
        $questionRequest = new QuestionRequest();
        $this->response = $questionRequest->getById((int) $arg1);
    }
}
