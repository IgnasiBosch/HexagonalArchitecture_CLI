<?php

namespace Hexagonal\Task;


interface TaskGatewayInterface
{
    public function findAll();
    
    public function find($id);

    public function findLikeDescription($name);

    public function save(Task $user);

    public function update(Task $user);
}