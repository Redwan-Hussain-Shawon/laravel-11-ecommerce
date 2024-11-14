<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    public function subcategory(){
        return $this->hasOne(Subcategory::class,'id','subcategory_id');
    }

    protected $fillable = ['category_id','subcategory_id','childcategory_name','childcategory_slug'];
}
