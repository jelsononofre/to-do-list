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
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function findById($id)
    {
        return Task::where('id', '=', $id)
            ->get()
            ->toArray();
    }

    public function delete($id)
    {
        return Task::where('id', '=', $id)
            ->delete();
    }
}