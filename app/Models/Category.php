<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',     
        'image',
        'meta_keyword',
        'meta_description',
        'status',
        
    ];

    public function products(){

        return $this->hasMany(Product::class);
    }

    public function brands(){

        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status','0');
    }
}
