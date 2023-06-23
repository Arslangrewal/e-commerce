<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id'
    ];

    public function product(){

        return $this->hasMany(Product::class);
    }

    public function category(){

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
