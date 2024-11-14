<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
     public function contact(){
        return $this->hasOne(Contact::class,'student_id');
     }
     protected $fillable = [
      'name',
      'email',
      'password',
  ];
  protected function casts()
  {
   return [
      'password'=>'hashed'
   ];
  }
}
