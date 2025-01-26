<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Profile extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'bio',
        'gender',
        'facebook',
        'whatsapp',
        'linkedin',
        'svu_email',
        'photo'
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            $profile->slug = Str::slug($profile->name);
        });

        static::updating(function ($profile) {
            $profile->slug = Str::slug($profile->name);
        });
    }
   /**
    * Get the user that owns the Profile
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id');
   }
}
