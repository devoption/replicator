<?php

namespace App\Models;

use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'title', 'summary', 'details', 'shared_at'])]
class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'shared_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
