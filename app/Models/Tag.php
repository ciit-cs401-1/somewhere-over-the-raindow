<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    /**
     * Get the posts for the tag.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Generate slug from name
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $slug = Str::slug($tag->name);
                $originalSlug = $slug;
                $count = 2;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$originalSlug}-" . $count++;
                }

                $tag->slug = $slug;
            }
        });
    }
}
