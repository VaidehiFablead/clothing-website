<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Table name is singular
    protected $table = 'category';

    // Primary key is category_id
    protected $primaryKey = 'category_id';

    // Disable timestamps if your table doesn't have created_at and updated_at
    public $timestamps = false;

    // Allow mass assignment for the 'name' column
    protected $fillable = ['name'];
}
