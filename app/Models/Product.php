<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'content',
        'short_description',
        'quantity',
        'views',
        'price',
        'number_of_vote_submissions',
        'total_vote',
        'sold',
        'status'
    ];

    /**
     * Get the categories that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasManyThrough(
            ProductTag::class,
            Tag::class
        );
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rates()
    {
        return $this->hasMany(Comment::class);
    }
}
