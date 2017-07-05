<?php

namespace App\Task;

use Hexagonal\Task\TaskService;
use Hexagonal\Common\ValidationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateTaskCommand extends Command
{
    /**
     * @var TaskService
     */
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('task:create')
            ->setDescription('Creates a new task.')
            ->setHelp('This command allows you to create a task...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Task description: ', false);
        $description = $helper->ask($input, $output, $question);
        try{
            $this->service->saveFromAssoc(['description' => $description]);
            $output->writeln('Task successfully generated!');
        } catch (ValidationException $exc) {
            $output->writeln(join(' and ', $exc->getErrors()['description']));
            $this->execute($input, $output);
        }
    }
}