<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand_id',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
        
    ];


    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function productImages()
    {
        return $this->hasMany(productImage::class, 'product_id', 'id');
    }

    public function productColors(){

        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function brand(){

        return $this->belongsTo(Brand::class,'brand_id', 'id');
    }

   
}
