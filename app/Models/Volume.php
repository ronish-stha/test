<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    use HasFactory;

    protected $fillable = ['volume', 'quantity'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function productVariants()    {
        return $this->hasMany(ProductVariant::class);
//        return $this->belongsToMany(ProductVariant::class, 'product_variants', 'volume_id', 'product_id');
    }

    public function sellerVolume() {
        return $this->hasMany(Volume::class);
    }
}
