<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magazzino;

class MagazzinoController extends Controller
{

    public function aggiungi(Request $request)
    {
        $data = $request->all();

        Magazzino::create($data);

        return redirect('/');
    }

    public function index()
    {
        $prodotti = Magazzino::where('giacenza', '>', 0)->get();
        
        return view('index', compact('prodotti'));
    }

    public function compra(Magazzino $prodotto)
    {
        $prodotto->update(['giacenza' => $prodotto->giacenza - 1]);
        
        return redirect('/');
    }

    public function elimina(Magazzino $prodotto)
    {
        $prodotto->delete();
        
        return redirect('/');
    }
}
