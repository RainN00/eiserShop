<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'content',
        'rating',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}