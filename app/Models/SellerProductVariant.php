<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProductVariant extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sellerProduct() {
        return $this->belongsTo(SellerProduct::class);
    }

    public function sellerVolume() {
        return $this->belongsTo(SellerVolume::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
