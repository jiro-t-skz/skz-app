<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradePost extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'type',
        'target',
        'contact_info',
        'date',
        'place',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(TradePostComment::class)->latest();
    }
}
