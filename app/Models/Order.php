<?php

namespace App\Models;

use App\Http\Controllers\OrdersController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrdersFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'total_price',
        'status',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    
}
