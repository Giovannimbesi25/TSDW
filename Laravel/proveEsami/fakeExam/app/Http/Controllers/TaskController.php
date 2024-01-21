<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;    

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($project_id = 0)
    {
        return view('tasks.create', compact('project_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Project::findOrFail($request->input('project_id'));
        }catch(ModelNotFoundException $e){
            return response('<a href="/">Project ID NOT VALID RETURN HOME</a>');
        }
        Task::create($request->all());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try{
            Project::findOrFail($request->input('project_id'));
        }catch(ModelNotFoundException $e){
            return response('<a href="/">Project ID NOT VALID RETURN HOME</a>');
        }
        $task->update($request->all());
        return redirect("/tasks/$task->id/edit");    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/');
    }

    public function help_show(){
        $id = request('id');
        return redirect("/tasks/$id");
    }

    public function help_create()
    {
        $project_id = request('project_id');
        return $this->create($project_id);
    }

    public function destroyAll(){
        $tasks = Task::all();
        foreach($tasks as $task){
            $task->delete();
        }
        return redirect("/");
    }
}
