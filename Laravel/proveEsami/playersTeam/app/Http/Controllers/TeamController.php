<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = team::all();
        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        team::create($request->all());
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(team $team)
    {
        return view("team.show", compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(team $team)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, team $team)
    {   
        $team->update($request->all());
        return redirect("/teams/$team->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(team $team)
    {
        $team->delete();
        return redirect("/");
    }
}
