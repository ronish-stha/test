<?php

namespace App\Models;

use App\Review;
use App\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    /*public function products() {
        return $this->belongsToMany(WishList::class, 'wish_list', 'user_id', 'product_id');
    }*/

    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($roles) {
        if ($this->roles()->where('title', $roles)->first()) {
            return true;
        }

        return false;
    }

    public function passwordReset() {
        return $this->hasOne(PasswordReset::class);
    }

    public function sellerDetail() {
        return $this->hasOne(SellerDetail::class);
    }

    public function sellerProducts() {
        return $this->hasMany(SellerProduct::class);
    }

    public function sellerProductVariants() {
        return $this->hasMany(SellerProductVariant::class);
    }

    public function productVariants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function verifyUser() {
        return $this->hasOne(VerifyUser::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_sellers', 'user_id', 'product_id');
    }
}
