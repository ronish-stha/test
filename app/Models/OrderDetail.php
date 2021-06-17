<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function seller() {
        return $this->belongsTo(User::class);
    }

    public function sellerOrder() {
        return $this->belongsTo(Order::class);
    }

    public function productVariant() {
        return $this->belongsTo(ProductVariant::class);
    }
}
