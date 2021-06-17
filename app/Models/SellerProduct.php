<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerProduct extends Model
{
    use HasFactory;

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variants', 'seller_product_id', 'volume_id');
    }*/

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function sellerProductVariants()
    {
        return $this->hasMany(SellerProductVariant::class);
//        return $this->belongsToMany(SellerProductVariant::class, 'product_variants', 'seller_product_id', 'volume_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
