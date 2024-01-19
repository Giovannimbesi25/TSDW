<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::all();
        return view('classe.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Classe::create($request->all());
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class)
    {
        //se non chiamo l'oggetto come specificato nella route l'automatic binding non funziona
        return view('classe.show', compact('class'));
    }   
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $classe = Classe::find($id);
        $classe->update($request->all());
        return view('classe.show', compact('classe'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        return redirect("/");
    }
}
