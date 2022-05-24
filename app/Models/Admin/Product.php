<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'slug',
        'description',
        'short_description',
        'brand',
        'model',
        'keywords',
        'technical_specification',
        'uses',
        'warranty',
        'status',
        'lead_time',
        'tax_id',
        'is_promo',
        'is_featured',
        'is_discounted',
        'is_trending',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function Tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }

    public function Product_Attributes()
    {
        return $this->hasMany(Product_Attributes::class, 'product_id', 'id');
    }
}
