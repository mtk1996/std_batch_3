<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'supplier_id', 'total_quantity', 'buy_price',
        'buy_date', 'description'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
