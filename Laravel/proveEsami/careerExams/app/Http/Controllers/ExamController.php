<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Career;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $careers = Career::all();
        return view('exam.create', compact('careers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Exam::create($request->all());
        return redirect("/exams");
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $careers = Career::all();
        return view('exam.show', compact('exam', 'careers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->all());
        return $this->show($exam);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect("/exams");
    }
    public function deleteAll()
    {
        $exams = Exam::all();
        foreach($exams as $exam){
            $exam->delete();
        }
        return redirect("/exams");
    }
}
