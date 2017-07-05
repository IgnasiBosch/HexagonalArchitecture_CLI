<?php

namespace App\Task;

use Hexagonal\Task\Task;
use Hexagonal\Task\TaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ListTasksLikeCommand extends Command
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
            ->setName('task:list-like')
            ->setDescription('List all tasks with description like.')
            ->setHelp('This command allows you to show all tasks with description like...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $helper = $this->getHelper('question');
        $question = new Question('Search tasks with description like: ', false);
        $description = $helper->ask($input, $output, $question);

        $tasks = $this->service->findLikeDescription($description);
        $tasks->each(function ($task) use ($output) {
            /** @var Task $task */
            $output->writeln($task->getId() . " - " . $task->getDescription());
        });

    }
}