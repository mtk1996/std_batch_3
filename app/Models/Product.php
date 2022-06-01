<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id', 'brand_id', 'category_id',
        'slug', 'name', 'image', 'description',
        'total_quantity', 'sale_price', 'buy_price',
        'view_count', 'like_count'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/images/' . $this->image);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function addTransaction()
    {
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function removeTransaction()
    {
        return $this->hasMany(ProductRemoveTransaction::class);
    }

    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
