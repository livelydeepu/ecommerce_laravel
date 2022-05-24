<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = ['tax_name', 'tax_value'];

    public $table = "taxes";

    public function Products()
    {
        return $this->hasMany(Product::class, 'tax_id');
    }
}
