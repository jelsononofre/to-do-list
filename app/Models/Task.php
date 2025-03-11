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

    public const STATUS = [
        self::PENDING => 'Pendente',
        self::WORK_IN_PROGRESS => 'Em andamento',
        self::FINISHED => 'Finalizado',
        self::CANCELLED => 'Cancelado'
    ];

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'info',
        'created_by'
    ];
}
