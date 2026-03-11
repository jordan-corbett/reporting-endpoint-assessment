<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkTask extends Model
{
    /** @use HasFactory<\Database\Factories\WorkTaskFactory> */
    use HasFactory;

    protected $fillable = [
        'call_id',
        'resolution_type_id',
        'work_started_at',
        'work_completed_at'
    ];

    public function call(): BelongsTo
    {
        return $this->belongsTo(Call::class);
    }

    public function resolutionType(): BelongsTo
    {
        return $this->belongsTo(ResolutionType::class);
    }
}
