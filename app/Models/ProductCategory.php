<?php

// Đây là dòng comment đầu tiên
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories'; 
    protected $fillable = [
        'name',
        'content',
    ];
}