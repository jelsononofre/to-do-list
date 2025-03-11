<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Auth\Authenticatable;

class TaskRepository
{
    public function create(array $params)
    {
        return Task::create($params);
    }

    public function getAll(Authenticatable $authUser)
    {
        return Task::where("created_by", '=', $authUser->name)
            ->get()
            ->toArray();
    }
}