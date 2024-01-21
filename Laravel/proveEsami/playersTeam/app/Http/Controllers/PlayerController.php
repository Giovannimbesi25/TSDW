<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\player;
use App\Models\team;
use Illuminate\Http\Request;
class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players=player::all();
        return view('player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($team_id = 0)
    {
        return view('player.create', compact('team_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            team::findOrFail(request('team_id'));
        }catch (ModelNotFoundException $exception) {
            return response("TEAM ID NOT VALID");
        }        
        player::create($request->all());
        return redirect("/");
    }


    /**
     * Display the specified resource.
     */
    public function show(player $player)
    {
        return view('player.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, player $player)
    {
        try{
            team::findOrFail(request('team_id'));
        }catch (ModelNotFoundException $exception) {
            return response("TEAM ID NOT VALID");
        }   
        $player->update($request->all());
        return redirect("/players/$player->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(player $player)
    {
        $player->delete();
        return redirect("/players");
    }
}
