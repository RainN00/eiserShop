<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'notes',
        'status',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderDetail::class,
            'order_id',
            'id',
            'id',
            'product_id'
        );
    }
}
