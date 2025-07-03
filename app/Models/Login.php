<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table='login';

    protected $primaryKey = 'email'; // using email as unique key
    public $incrementing = false;    // email is not auto-increment
    public $timestamps = false; 

    protected $fillable=[
        'name',
        'email',
        'password'
    ];
}
