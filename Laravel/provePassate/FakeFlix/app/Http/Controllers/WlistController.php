<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wlist;

class WlistController extends Controller
{
    public function insert(Request $request){
        $film = [
            "titolo" => $request->input('titolo'),
            "regista" => $request->input('regista')
        ];
        Wlist::create($film);

        return redirect('/');
    }

    public function list(){
        $films = Wlist::all();
        return view('Wlist.welcome', compact('films'));
    }

    public function truncate(){
        $films = Wlist::truncate();
        return redirect('/');
    }
}
