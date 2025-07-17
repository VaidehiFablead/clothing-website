<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

     protected $table = 'order';

    protected $fillable = [
        'customer_id',
        'subtotal' // now only this, product info is removed
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
