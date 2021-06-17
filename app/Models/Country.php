<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function productVariants() {
        return $this->hasManyThrough(ProductVariant::class, Product::class)->where('status', 1);
    }
}
