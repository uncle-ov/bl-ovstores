<?php

namespace App\Models;
use SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $hidden = [
        'category_id', 'manufaturer_id', 'name', 'short_description', 'price',
    ];

    public function thumbnail() {
        return $this->hasOne(ProductMedia::class)
                    ->where('purpose', 'thumbnail')
                    ->take(1);
    }

    public function category() {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    public function media() {
        return $this->hasMany(ProductMedia::class)
                    ->where('purpose', 'NOT LIKE', 'thumbnail');
    }

    public function sizes() {
        return $this->hasMany(ProductSize::class);
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class);
    }

    public function manufacturer() {
        return $this->hasOne(ProductManufacturer::class, 'id', 'manufacturer_id');
    }
}
