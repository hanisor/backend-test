<?php

namespace App\Models;

use App\Http\Controllers\OrderItemsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemsFactory> */
    use HasFactory;
    protected $fillable = ['order_id', 'product_name', 'quantity', 'price'];

    public function orders()
    {
        return $this->belongsTo(orders::class);
    }
}
