<?php

namespace  Webserver\Entity;

use Webserver\Enum\EnumQuestionStatus;

class Question implements \JsonSerializable, ResolvableInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $promoted;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var string
     */
    private $status;

    /**
     *@var \ArrayObject
     */
    private $answers;

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->answers = new \ArrayObject();
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
     * @return Question
     */
    public function setId(int $id): Question
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Question
     * @throws \Exception
     */
    public function setTitle(string $title): Question
    {
        $this->title = $title;
        $this->updated = new \DateTime();
        return $this;
    }

    /**
     * @return bool
     */
    public function isPromoted(): bool
    {
        return $this->promoted;
    }

    /**
     * @param bool $promoted
     * @return Question
     * @throws \Exception
     */
    public function setPromoted(bool $promoted): Question
    {
        $this->promoted = $promoted;
        $this->updated = new \DateTime();

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return Question
     */
    public function setCreated(\DateTime $created): Question
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return Question
     */
    public function setUpdated(\DateTime $updated): Question
    {
        $this->updated = $updated;

        return $this;
    }


    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Question
     * @throws \Exception
     */
    public function setStatus(string $status): Question
    {
        $this->status = $status;
        $this->updated = new \DateTime();
        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getAnswers(): \ArrayObject
    {
        return $this->answers;
    }

    /**
     * @param \ArrayObject $answers
     * @return Question
     * @throws \Exception
     */
    public function setAnswers(\ArrayObject $answers): Question
    {
        $this->answers = $answers;
        $this->updated = new \DateTime();
        return $this;
    }

    /**
     * @param Answer $answer
     * @return Question
     * @throws \Exception
     */
    public function addAnswer(Answer $answer): Question
    {
        $this->answers->append($answer);
        $this->updated = new \DateTime();
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'promoted' => $this->promoted,
            'updated' => $this->updated->format("Y-m-d H:i:s"),
            'status' => $this->status,
            'answers' => $this->answers,
        ];
    }

    /**
     * @inheritDoc
     */
    public function resolve(array $array): ResolvableInterface
    {
        foreach ($array as $key => $value) {
            switch ($key){
                case "title":
                    $this->setTitle($value);
                    break;
                case "status":
                    if(EnumQuestionStatus::isValid($value)) {
                        $this->setStatus($value);
                    }
                    break;
                //TODO
            }
        }
        return $this;
    }
}