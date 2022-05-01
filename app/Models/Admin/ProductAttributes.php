<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'attr_image',
        'mrp',
        'price',
        'quantity',
        'size_id',
        'color_id'
    ];

    public function Products()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function Size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function Color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
