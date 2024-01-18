<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lettera;


class LetteraController extends Controller
{

    public function index()    
    {
        $lettere = lettera::where('consegnata', 0)->get();
        return view('lettera.index', compact('lettere'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['consegnata'] = 0;
        lettera::create($data);

        return redirect("/letteras");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lettera = lettera::find($id);
        return view('lettera.about', compact('lettera'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lettera = lettera::find($id);
        $lettera->update($request->all());
        return view('lettera.about', compact('lettera'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $lettera = lettera::find($id);
        $lettera->delete();
        return redirect("/letteras");
    }

    public function befana(){
        $lettere = lettera::where('consegnata', 0)->get();
        foreach($lettere as $lettera){
            $lettera->update(['quantità' => $lettera->quantità * 2 ]);
        }

        return redirect("/letteras");
    }

    public function consegna(string $id)
    {
        $lettera = lettera::find($id);
        $lettera->update(['consegnata' => 1]);
        
        return redirect("/letteras");
    }
}
