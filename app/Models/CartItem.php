<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
	protected $fillable = [
        'user_id',
        'guest_id',
        'product_id',
        'size',
        'quantity',
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
