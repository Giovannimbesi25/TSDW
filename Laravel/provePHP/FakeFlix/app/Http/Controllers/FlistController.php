<?php

namespace App\Http\Controllers;
use App\Models\Flist;
use Illuminate\Http\Request;

class FlistController extends Controller
{
    public function welcome(){
        $film = Flist::inRandomOrder()->first();
    
        return view('Flist.welcome', compact('film'));
    }

    public function search(Request $request){
        $titolo = $request->input('titolo');
        $regista = $request->input('regista');
        $films = Flist::where('titolo', $titolo)->orWhere('regista', $regista)->get();

        if($films->count()>0){
            return view('Flist.search', compact('films'));
        }else{
            return view ('Flist.search', compact('titolo', 'regista'));
        }
    }
}
