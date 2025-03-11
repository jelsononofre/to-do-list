<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public const COLLECTION = 'tasks';
    public const PENDING = 0;
    public const WORK_IN_PROGRESS = 1;
    public const FINISHED = 2;
    public const CANCELLED = 3;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'info',
        'created_by'
    ];
}
