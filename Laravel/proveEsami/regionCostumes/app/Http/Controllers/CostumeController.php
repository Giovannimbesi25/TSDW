<?php

namespace App\Http\Controllers;

use App\Models\Costume;
use App\Models\Region;

use Illuminate\Http\Request;

class CostumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costumes = Costume::all();
        return view('costume.index', compact('costumes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('costume.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Costume::create($request->all());
        return redirect("/costumes");
    }

    /**
     * Display the specified resource.
     */
    public function show(Costume $costume)
    {
        $regions = Region::all();
        return view('costume.show', compact('costume', 'regions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Costume $costume)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Costume $costume)
    {
        $costume->update($request->all());
        return redirect("/costumes/$costume->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Costume $costume)
    {
        $costume->delete();
        return redirect("/costumes");
    }

    
    public function dimezza()
    {
        $costumes = Costume::all();
        foreach($costumes as $costume){
            $costume->update([
                'prezzo' => ($costume->prezzo / 2)
            ]);
        }
        return redirect("/costumes");
    }
}
