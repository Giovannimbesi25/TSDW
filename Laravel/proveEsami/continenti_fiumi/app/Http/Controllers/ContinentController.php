<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Continent;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $continents = Continent::all();
        return view('continent.index', compact('continents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('continent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Continent::create($request->all());
        return redirect("/continents");
    }

    /**
     * Display the specified resource.
     */
    public function show(Continent $continent)
    {
        return view('continent.show', compact('continent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Continent $continent)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Continent $continent)
    {
        $continent->update($request->all());
        return redirect("/continents/$continent->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Continent $continent)
    {
        $continent->delete();
        return redirect("/continents");
    }

    public function searchByName(Request $request)
    {
        $nome = $request->input('nome');
        
        try {
            $continent = Continent::where('nome', 'like', '%' . $nome . '%')->firstOrFail();
            return redirect("/continents/$continent->id");
        } catch (ModelNotFoundException $e) {
            return redirect("/");
        }
    }

    public function deleteAll()
    {
        $continents = Continent::all();
        foreach($continents as $continent){
            $continent->delete();
        }
        return redirect("/continents");
    }
}
