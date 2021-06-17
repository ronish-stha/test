<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerAd extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'discount', 'status', 'heading1', 'heading2', 'code', 'offer', 'type', 'expiry_date'];

    public function bannerAdEmails() {
        return $this->hasMany(BannerAdEmail::class);
    }
}
