<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sellerProduct()
    {
        return $this->belongsTo(SellerProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentVolume()
    {
        return $this->belongsTo(Volume::class, 'volume_id', 'id');
    }

    public function orderDetail() {
        return $this->hasMany(ProductVariant::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
