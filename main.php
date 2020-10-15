<?php
require_once  './vendor/autoload.php';

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Output\ConsoleOutput;
use Webserver\Command\MainCommand;
use Webserver\Command\GetQuestionCommand;
use Webserver\Command\UpdateQuestionCommand;
$application = new ConsoleApplication();

if ($argc == 1) {
    echo "Merci de choisir une action \n";
    return 0;
}
$options = array_slice($argv, 1);
/** @var \Symfony\Component\Console\Command\Command|null*/
$command = null;
if (strtoupper($options[0]) == 'GET') {
    $getQuestionCommand = new GetQuestionCommand();
    $getQuestionCommand->setHidden(false);
    $application->add($getQuestionCommand);
    $options = array_merge(['main.php', 'webserver:get-question-data'], array_slice($options, 1));
} elseif (strtoupper($options[0]) == 'UPDATE') {
    $updateQuestionCommand = new UpdateQuestionCommand();
    $updateQuestionCommand->setHidden(false);
    $application->add($updateQuestionCommand);
    $options = array_merge(['main.php', 'webserver:update-question-data'], array_slice($options, 1));

}
$application->run(new \Symfony\Component\Console\Input\ArgvInput($options));