<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'category_slug', 'parent_category_id', 'category_image'];

    public function Products() {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function getParentNames() {
        if($this->parent) {
            return $this->parent->getParentNames(). " > " . $this->category_name;
        } else {
            return $this->category_name;
        }
    }

    static function getDepth($parent_id) {
        $categories = Category::find($parent_id);
 
        if ($categories) {
            if ($categories->parent_id == 0) {
                return $categories->category_name;
            } else {
                return self::getDepth($categories->parent_category_id);
            }
        }
    }
}


