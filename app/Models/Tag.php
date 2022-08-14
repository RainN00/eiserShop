<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasManyThrough(
            ProductTag::class,
            Product::class
        );
    }

    public function productstag()
    {
        return $this->belongsToMany(
            Product::class,
            'product_tag',
            'tag_id',
            'product_id'
        );
    }
}
