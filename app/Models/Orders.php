<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $tables = 'order';

    protected $fillable = [
        'customer_id',
        'product_name',
        'qty',
        'price',
        'subtotal'
    ];

    // ✅ Relationship: An order belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
