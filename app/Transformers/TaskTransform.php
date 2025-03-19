<?php

namespace App\Transformers;

use App\Helpers\Utils;
use App\Models\Task;
use League\Fractal\TransformerAbstract;

class TaskTransform extends TransformerAbstract
{
    public function transform($object)
    {
        $statusCode = $object['status'];
        $createdAt = $object['created_at'];
        $updatedAt = $object['updated_at'];

        return [
            'id' => $object['id'],
            'taskInfo' => [
                'title' => $object['title'],
                'description' => $object['description']
            ],
            'status' => [
                'code' => (int) $statusCode,
                'name' => Task::STATUS[$statusCode]
            ],
            'createdBy' => $object['created_by'],
            'createdAt' => Utils::formatDate($createdAt),
            'updatedAt' => Utils::formatDate($updatedAt)
        ];
    }
}