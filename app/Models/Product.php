<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

class Product extends Model
{
//    use Searchable;

    //Table Name
    protected $table='products';

    //Primary Key
    public $primaryKey='id';

    //Timestamps
    public $timestamps = true;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function saleDetails() {
        return $this->hasMany(SaleDetail::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    /*public function users() {
        return $this->belongsToMany(User::class, 'wish_list', 'product_id', 'user_id');
    }*/

    public function users() {
        return $this->belongsToMany(User::class, 'product_sellers', 'product_id', 'user_id');
    }

    public function sellerProducts() {
        return $this->hasMany(SellerProduct::class);
    }

    public function volumes() {
        return $this->hasMany(Volume::class);
    }

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function maxPrice() {
        return (int)$this->productVariants()->where('status', 1)->max('price');
    }

    public function minPrice() {
        return (int)$this->productVariants()->where('status', 1)->min('price');
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
