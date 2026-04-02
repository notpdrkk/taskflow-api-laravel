<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'description',
        'status',
        'deadline'
    ];

    public function casts(): array
    {
        return ['deadline' => 'date',];
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
