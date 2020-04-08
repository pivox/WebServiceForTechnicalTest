<?php

declare(strict_types=1);

namespace Webserver\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webserver\Request\QuestionRequest;
use Webserver\Request\Retrieve;

class GetQuestionCommand  extends Command
{
    protected static $defaultName = 'webserver:get-question-data';

    protected function configure()
    {
        $this
            ->setDescription('Get Question Data')
            ->addOption('id_question', null, InputOption::VALUE_OPTIONAL, 'id question ?')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $questionRequest = new QuestionRequest();
        $idQuestion = $input->getOption('id_question');
        $result = null;
        if ($idQuestion) {
            $result = $questionRequest->getById((int)$idQuestion);
        } else {
            $result = $questionRequest->getAll();
        }
        dump($result);
        return 0;
    }
}