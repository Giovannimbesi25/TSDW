<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
//esempio di dependency injection, l'oggetto controller ha bisogno di una dipendenza, "Request" che viene 
//fornita da Laravel quando richiamata dai diversi metodi del controller
//Ogni metodo avrà dunque la sua request 


class MyFirstController extends Controller
{
    public function index($param1, $param2){

        $model = [
            "p1" => $param1 ,
            "p2" => $param2
        ];

        return view('hello-view', $model);
    }

    public function queryParam(Request $request){
        //Get parameter
        $all = $request->all();
        var_dump($all);

        //oppure

        $p1 = $request->input('p1');

        echo '<br>'.$p1;
    }
}
