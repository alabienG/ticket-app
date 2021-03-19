<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   public $exist = false;

   public function user()
   {
       return $this->belongsToMany('App\User', 'role_users');
   }
}
