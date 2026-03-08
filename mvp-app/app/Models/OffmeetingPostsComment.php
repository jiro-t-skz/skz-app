<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffmeetingPostsComment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'offmeeting_posts_id',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offmeetingPost(): BelongsTo
    {
        return $this->belongsTo(OffmeetingPost::class, 'offmeeting_posts_id');
    }
}
