<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'price_old', 'price_new', 'sku', 'stock_quantity', 'status', 
        'category_id', 'sub_category_id', 'brand_id', 'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
