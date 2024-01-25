<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::all();
        return view('career.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('career.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Career::create($request->all());
        return redirect("/careers");
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        return view('career.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $career->update($request->all());
        return $this->show($career);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return redirect("/careers");
    }

    public function deleteAll()
    {
        $careers = Career::all();
        foreach($careers as $career){
            $career->delete();
        }
        return redirect("/careers");
    }
}
