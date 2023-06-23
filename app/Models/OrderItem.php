<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    
    ];

        /**
         * Get the product that owns the OrderItem
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */

        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class,'product_id', 'id'); 
        }
        
        public function productColor(): BelongsTo
        {
            return $this->belongsTo(productColor::class, 'product_color_id', 'id');
        }

        
}
