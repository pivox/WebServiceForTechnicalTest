<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;


/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**  @var \Webserver\Entity\Question */
    private $question;

    /** @var array */
    private $params = ['main.php'];

    /**
     * @Given /^I a am a Question with id equals "([^"]*)"$/
     */
    public function iAAmAQuestionWithIdEquals($arg1)
    {
        if($arg1 != 1) {
            throw new PendingException( "Argument id must equal to one");
        }
        $answer = new \Webserver\Entity\Answer(1, \Webserver\Enum\EnumChannel::BOT, "body toto");

        $question = new \Webserver\Entity\Question();
        $this->question = $question->setId($arg1)
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
        \PHPUnit\Framework\Assert::assertEquals('title=behatValue', $arg1);
        $this->params[] = 'title=behatValue';
    }

    /**
     * @Given /^Question Status to update with value "([^"]*)"$/
     */
    public function questionStatusToUpdateWithValue($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals("status=draft", $arg1);
        $this->params[] = 'status=draft';
    }

    /**
     * @When /^I send the data$/
     */
    public function iSendTheData()
    {
        $application = new \Webserver\Application($this->params);
        $curl = new \Webserver\Curl();
        $application
            ->setQuestion($this->question)
            ->resolveInputs();
        $this->response = $curl->put($application->getJsonForSend());
    }

    /**
     * @Then /^I get response as an empty array$/
     */
    public function iGetResponseAsAnEmptyArray()
    {
        \PHPUnit\Framework\Assert::assertEmpty(json_decode($this->response, true));
    }
}
