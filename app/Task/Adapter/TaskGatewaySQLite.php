<?php

namespace App\Task\Adapter;


use Hexagonal\Task\Task;
use Hexagonal\Task\TaskFactory;
use Hexagonal\Task\TaskGatewayInterface;
use PDO;

class TaskGatewaySQLite implements TaskGatewayInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * TaskGatewaySQLite constructor.
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function findAll()
    {
        $sql = 'SELECT * FROM tasks;';
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return TaskFactory::createAllFromAttributes($query->fetchAll(PDO::FETCH_OBJ));
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function findLikeDescription($description)
    {
        $sql = 'SELECT * FROM tasks WHERE description LIKE :description;';
        $query = $this->pdo->prepare($sql);
        $like =  '%' . $description . '%';
        $query->execute([':description' => $like]);
        return TaskFactory::createAllFromAttributes($query->fetchAll(PDO::FETCH_OBJ));
    }

    public function save(Task $task)
    {
        $sql = 'INSERT INTO tasks(description) VALUES(:description)';
        $query = $this->pdo->prepare($sql);
        $query->execute([':description' => $task->getDescription()]);

        return $this->pdo->lastInsertId();
    }

    public function update(Task $task)
    {
        // TODO: Implement update() method.
    }
}