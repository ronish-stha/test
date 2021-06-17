<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerVolume extends Model
{
    use HasFactory;

    public function sellerProduct() {
        return $this->belongTo(SellerProduct::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function sellerProductVariants()    {
        return $this->belongsToMany(ProductVariant::class, 'product_variants', 'volume_id', 'product_id');
    }

    public function parentVolume() {
        return $this->belongsTo(Volume::class);
    }
}
