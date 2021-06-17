<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerAdEmail extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'banner_ad_id', 'status'];

    public function bannerAd() {
        return $this->belongsTo(BannerAd::class);
    }
}
