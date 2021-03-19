<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
