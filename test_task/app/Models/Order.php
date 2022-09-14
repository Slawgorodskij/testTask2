<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
      'buyers_id',
      'products_id',
      'count_product',
      'total_price',
       'order_status',
    ];

    public function buyers()
    {
        return $this->belongsTo(Buyer::class, 'buyers_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
