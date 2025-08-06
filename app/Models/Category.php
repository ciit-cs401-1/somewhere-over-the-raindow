<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id'
    ];

    /**
     * Get the posts for the category.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Generate slug from name
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $slug = Str::slug($category->name);
                $originalSlug = $slug;
                $count = 2;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$originalSlug}-" . $count++;
                }

                $category->slug = $slug;
            }
        });
    }
}
