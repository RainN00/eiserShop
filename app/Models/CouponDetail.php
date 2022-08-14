<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDetail extends Model
{
    use HasFactory;

    protected $table = "coupon_detail";

    protected $fillable = [
        'user_id',
        'coupon_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
