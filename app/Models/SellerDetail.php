<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerDetail extends Model
{
    use HasFactory;

    protected $fillable = ['store_name', 'owner_name', 'address', 'location', 'district', 'province', 'business_registration'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
