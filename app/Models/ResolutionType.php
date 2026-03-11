<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResolutionType extends Model
{
    /** @use HasFactory<\Database\Factories\ResolutionTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function workTasks(): HasMany
    {
        return $this->hasMany(WorkTask::class);
    }
}
