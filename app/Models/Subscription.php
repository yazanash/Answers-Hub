<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
