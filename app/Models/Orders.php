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
        'product_name',
        'qty',
        'price',
        'subtotal'
    ];
}
