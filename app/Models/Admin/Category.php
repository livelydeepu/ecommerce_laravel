<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'category_slug', 'parent_category_id', 'category_image'];

    public function Products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}


