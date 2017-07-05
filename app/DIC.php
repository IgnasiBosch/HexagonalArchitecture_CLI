<?php
namespace App;

use App\Task\Adapter\TaskGatewaySQLite;
use Hexagonal\Task\Adapter\TaskValitronValidator;
use Hexagonal\Task\TaskRepository;
use Hexagonal\Task\TaskService;
use Pimple\Container;



$DIC = new Container();


$DIC['DB'] = function () {
    return new DB('app.db');
};

$DIC['Service\Task'] = function ($dic) {
    $gateway = new TaskGatewaySQLite($dic['DB']->get());
    $repository = new TaskRepository($gateway);
    return new TaskService($repository, new TaskValitronValidator);
};


