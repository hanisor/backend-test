<?php

namespace App\Http\Controllers;

use App\Models\Order;   
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeorder_itemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order_items $order_items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order_items $order_items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateorder_itemsRequest $request, order_items $order_items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order_items $order_items)
    {
        //
    }
}
