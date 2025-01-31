<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Answer extends Model
{
    protected $fillable=[
        'user_id',
        'question_id',
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
   public function question(): BelongsTo
   {
       return $this->belongsTo(Question::class, 'question_id');
   }
   /**
    * The roles that belong to the Answer
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function helpfulVotes(): BelongsToMany
   {
       return $this->belongsToMany(User::class, 'helpful_votes', 'answer_id');
   }
  
}
