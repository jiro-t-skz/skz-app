<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OffmeetingPost extends Model
{
   use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'date',
        'prefecture',
        'place',
        'capacity',
         'contact_info'
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(OffmeetingPostsComment::class, 'offmeeting_posts_id')
            ->orderBy('created_at', 'asc');
    }

    // 検索スコープ
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where(function($q) use ($keyword) {
                $q->where('title', 'ilike', "%{$keyword}%")
                  ->orWhere('body', 'ilike', "%{$keyword}%")
                  ->orWhere('place', 'ilike', "%{$keyword}%");
            });
        }
        return $query;
    }

    public function scopeFilterByPrefecture($query, $prefecture)
    {
        if ($prefecture) {
            return $query->where('prefecture', $prefecture);
        }
        return $query;
    }
}