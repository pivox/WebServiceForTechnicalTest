<?php

declare(strict_types=1);

namespace Webserver\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question as CommandConsoleQuestion;
use Symfony\Component\Console\Question\ChoiceQuestion as CommandConsoleChoiceQuestion;
use Webserver\Entity\QuestionFactory;
use Webserver\Enum\EnumQuestionStatus;
use Webserver\Request\QuestionRequest;
use Webserver\Request\Retrieve;

class UpdateQuestionCommand  extends Command
{
    protected static $defaultName = 'webserver:update-question-data';

    protected function configure()
    {
        $this
            ->setDescription('Update Question Data')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'id question ?')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $questionRequest = new QuestionRequest();
        $idQuestion = $input->getOption('id');
        if (null === $idQuestion) {
            $output->writeln("Merci de saisir l'id de question");
            return 0;
        }
        $result = $questionRequest->getById((int)$idQuestion);
        $questionObject = QuestionFactory::getQuestion($result);

        $questionObject->setId((int) $idQuestion);

        $title = $this->askToEdit('title', $input, $output, [], $questionObject->getTitle());
        if (null !== $title) {
            $questionObject->setTitle($title);//TODO validation
        }

        $promoted = $this->askToEdit('promoted', $input, $output, [0 => 'false', 1 => 'true'], 'true');
        if (null !== $promoted) {
            $questionObject->setPromoted($promoted === 'true');
        }

        $status = $this->askToEdit('status', $input, $output, EnumQuestionStatus::getList(), EnumQuestionStatus::DRAFT);
        if (null !== $status) {
            $questionObject->setStatus($status);//TODO validation
        }
        $result = $questionRequest->editQuestion((int) $idQuestion, json_encode($questionObject));
        dump($result);
        return 0;
    }


    private function askToEdit(string $field, InputInterface $input, OutputInterface $output, array $listChoice = [], string $default)
    {
        $output->writeln("");
        $helper = $this->getHelper('question');
        $output->writeln("");
        if(0 === count($listChoice)) {
            $question = new CommandConsoleQuestion("Saisir la valeur de $field: \t", $default);

        } else {
            $question = new CommandConsoleChoiceQuestion("Saisir la valeur de $field ?\n", $listChoice, $default);
        }
        $response = $helper->ask($input, $output, $question);
        $output->writeln("");
        return $response;
    }
}