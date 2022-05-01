<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size', 'status'];

    public function ProductAttributes()
    {
        return $this->hasMany(ProductAttributes::class, 'size_id');
    }
}
