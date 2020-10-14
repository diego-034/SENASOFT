<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public function user() {
        return $this->hasOne(User::class, 'user_type', 'id');
    }
    
}
