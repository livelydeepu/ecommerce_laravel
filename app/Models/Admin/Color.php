<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['color', 'status'];

    public function ProductAttributes()
    {
        return $this->hasMany(ProductAttributes::class, 'color_id');
    }
}
