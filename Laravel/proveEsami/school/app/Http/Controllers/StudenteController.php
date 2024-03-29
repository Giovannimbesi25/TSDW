<?php

namespace App\Http\Controllers;

use App\Models\Studente;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studenti = Studente::all();
        return view('studente.index', compact('studenti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($class_id = 0)
    {
        return view('studente.create', compact('class_id'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Classe::findOrFail(request('class_id'));
        }catch(ModelNotFoundException $e){
            return response('<h1>Invalid Class ID</h1><a href="/">Home</a>');
        }
        Studente::create($request->all());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Studente $student)
    {
        return view('studente.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studente $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studente $student)
    {   
        try{
            Classe::findOrFail(request('class_id'));
        }catch(ModelNotFoundException $e){
            return response('<h1>Invalid Class ID</h1><a href="/">Home</a>');
        }
        $student->update($request->all());
        return redirect("/students/$student->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studente $student)
    {
        $student->delete();
        return redirect("/");
    }

    public function class_create(){
        
        $class_id = request('class_id');
        return $this->create($class_id);
    }
}
