<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getUserOrders()
    {
        $user = auth()->user();

        $orders = $user->orders()->with('orderItems')->get();
    
        return response()->json([
            'orders' => $orders
        ]);
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'items' => 'required|array',
            'items.*.product_name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Create a new order in `orders` table
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => 0, // Will calculate later
            'status' => 'pending',
        ]);

        $totalPrice = 0;

        // Insert order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Calculate total price
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Update total price in `orders` table
        $order->update(['total_price' => $totalPrice]);

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id,
            'total_price' => $totalPrice,
        ]);
    }

}
