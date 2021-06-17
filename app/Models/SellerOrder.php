<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerOrder extends Model
{
    use HasFactory;

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
