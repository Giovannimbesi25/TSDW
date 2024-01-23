<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $clients = Client::all();
        return view('order.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        order::create($request->all());
        return redirect("/orders");
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        $clients = Client::all();
        return view('order.show', compact('order', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect("/orders/$order->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect("/orders");
    }
}
