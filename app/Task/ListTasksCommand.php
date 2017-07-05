<?php

namespace App\Task;

use Hexagonal\Task\Task;
use Hexagonal\Task\TaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTasksCommand extends Command
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
            ->setName('task:list')
            ->setDescription('List all tasks.')
            ->setHelp('This command allows you to show all tasks...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->service->findAll();
        $tasks->each(function ($task) use ($output) {
            /** @var Task $task */
            $output->writeln($task->getId() . " - " . $task->getDescription());
        });
    }
}