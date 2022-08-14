<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'percent_discount',
        'quantity',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'coupon_detail',
            'coupon_id',
            'user_id'
        );
    }
}
