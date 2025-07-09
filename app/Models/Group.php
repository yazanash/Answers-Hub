<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
class Group extends Model
{
    protected $fillable = ['name','description','poster'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            $group->slug = Str::slug($group->name);
        });

        static::updating(function ($group) {
            $group->slug = Str::slug($group->name);
        });
    }
     /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'group_id');
    }
     /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'group_id');
    }
    
}
