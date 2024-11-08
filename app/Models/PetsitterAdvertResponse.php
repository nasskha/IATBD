<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetsitterAdvertResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'status',
        'petsitter_advert_id',
        'target_user_id',
    ];

    public function petsitterAdvert(): BelongsTo
    {
        return $this->belongsTo(PetsitterAdvert::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
