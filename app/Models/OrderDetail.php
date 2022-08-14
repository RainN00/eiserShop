<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_detail";

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
