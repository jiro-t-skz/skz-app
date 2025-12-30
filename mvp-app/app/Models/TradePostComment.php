<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradePostComment extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
    'user_id',
    'trade_post_id',
    'body',
   ];

   public function user()
   {
        return $this->belongsTo(User::class);
   }

   public function tradePost()
   {
        return $this->belongsTo(TradePost::class);
   }

}
