<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }
}
