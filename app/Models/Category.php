<?php
namespace App\Models;

use Franzose\ClosureTable\Models\Entity;
//use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Entity implements CategoryInterface
{
//    use LogsActivity;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $fillable = ['title'];
    protected static $logAttributes = ['title'];

    public $timestamps = true;

    /**
     * ClosureTable model instance.
     *
     * @var categoryClosure
     */
    protected $closure = 'App\Models\CategoryClosure';

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subProducts() {
        return $this->hasManyThrough(Product::class, Category::class, 'parent_id', 'category_id', 'id', 'id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function sellerProducts() {
        return $this->hasMany(Product::class);
    }

    public function country() {
        return $this->hasManyThrough(Country::class, Product::class);
    }

    public function volumes() {
        return $this->hasManyThrough(Volume::class, Product::class);
    }

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function sellerProductVariants() {
        return $this->hasMany(SellerProductVariant::class);
    }
}
