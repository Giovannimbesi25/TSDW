<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Fiume;
use App\Models\Continent;
use Illuminate\Http\Request;

class FiumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fiumes = Fiume::all();
        return view('fiume.index', compact('fiumes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $continents = Continent::all();
        return view('fiume.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Fiume::create($request->all());
        return redirect("/fiumes");
    }

    /**
     * Display the specified resource.
     */
    public function show(Fiume $fiume)
    {
        $continents = Continent::all();
        return view('fiume.show', compact('fiume', 'continents'));
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit(Fiume $fiume)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fiume $fiume)
    {
        $fiume->update($request->all());
        return redirect("/fiumes/$fiume->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fiume $fiume)
    {
        $fiume->delete();
        return redirect("/fiumes");
    }

    public function searchByName(Request $request)
    {
        $nome = $request->input('nome');
        try {
            $fiume = Fiume::where('nome', 'like', '%' . $nome . '%')->firstOrFail();
            return redirect("/fiumes/$fiume->id");
        } catch (ModelNotFoundException $e) {
            // Modello non trovato, reindirizza alla pagina iniziale 
            return redirect("/");
        }
    }



    public function deleteAll()
    {
        $fiumes = Fiume::all();
        foreach($fiumes as $fiume){
            $fiume->delete();
        }
        return redirect("/fiumes");
    }

}
