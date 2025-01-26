<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Post extends Model
{
    protected $fillable=[
        'user_id',
        'category_id',
        'group_id',
        'title',
        'content',
        'poster',
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
   public function category(): BelongsTo
   {
       return $this->belongsTo(Category::class, 'category_id');
   }
   public function group(): BelongsTo
   {
       return $this->belongsTo(Group::class, 'group_id');
   }
   /**
    * Get all of the comments for the Post
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function comments(): HasMany
   {
       return $this->hasMany(Comment::class, 'post_id');
   }
}
