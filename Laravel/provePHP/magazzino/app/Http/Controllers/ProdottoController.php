<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodotto;

class ProdottoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodotti = Prodotto::where('giacenza', '>', 0)->get();
        return view('prodotto.index', compact('prodotti'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Prodotto::create($request->all());

        return redirect("/prodotti");
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $prodotto = Prodotto::find($id);
        $prodotto->update(['giacenza' => $prodotto['giacenza'] - 1]);

        return redirect("/prodotti");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodotto = Prodotto::find($id);
        $prodotto->delete();
        return redirect("/prodotti");
    }
}
