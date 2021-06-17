<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table='sales';

    //Primary Key
    public $primaryKey='id';

    //Timestamps
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function saleDetails() {
        return $this->hasMany('App\SaleDetail');
    }
}
