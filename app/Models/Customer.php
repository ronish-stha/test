<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';

    //Primary Key
    public $primaryKey='id';

    //Timestamps
    public $timestamps = true;
}
