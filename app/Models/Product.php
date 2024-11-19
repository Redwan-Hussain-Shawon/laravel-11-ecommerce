<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'subcategory_id', 'brand_id', 'pickup_point_id', 'childcategory_id', 'name','slug', 'code', 'unit', 'purchase_price', 'selling_price', 'discount_price', 'stock_quantity', 'warehouse', 'description', 'video', 'tags', 'color', 'size', 'thumbnail', 'images', 'featured', 'today_deal', 'status', 'flash_deal_id', 'cash_on_delivery', 'admin_id'];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function subcategory(){
        return $this->hasOne(Subcategory::class,'id','subcategory_id');
    }

    public function childcategory(){
        return $this->hasOne(Childcategory::class,'id','childcategory_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function pickuppoint(){
        return $this->hasOne(Brand::class,'id','pickup_point_id');
    }


}
