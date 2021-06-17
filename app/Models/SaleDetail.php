<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public function sale() {
        return $this->belongsTo('App\Sale');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
