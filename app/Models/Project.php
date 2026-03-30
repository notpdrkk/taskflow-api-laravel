<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'status',
        'deadline'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
