<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('giacenza', '>', 0)->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('product.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
        Product::create($request->all());
        return redirect("/products");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $orders = Order::all();
        return view('product.show', compact('product', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect("/products/$product->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect("/products");
    }

    public function compra(Request $request){
        $product = Product::find(request('id'));
        $product->update([
            'giacenza' => $product->giacenza - 1
        ]);
        return redirect("/products/$product->id");
    }
}
