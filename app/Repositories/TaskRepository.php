<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function create(array $params)
    {
        return Task::create($params);
    }
}