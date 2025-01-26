<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // $table->foreignId('')->constrained()->onDelete('cascade');
    // $table->foreignId('')->constrained()->onDelete('cascade');
    // $table->text('content');
    protected $fillable=[
        'user_id',
        'post_id',
        'content',
    ];

   /**
    * Get the user that owns the Profile
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id');
   }
   public function post(): BelongsTo
   {
       return $this->belongsTo(User::class, 'post_id');
   }
}
