<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::latest()->get();

    $total = Task::count();
    $pending = Task::where('status', 'pending')->count();
    $inProgress = Task::where('status', 'in_progress')->count();
    $completed = Task::where('status', 'completed')->count();

    return view('tasks.index', compact(
        'tasks',
        'total',
        'pending',
        'inProgress',
        'completed'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }
    public function update(Request $request, Task $task)
{
    $request->validate([
        'title' => 'required|max:255',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect()->back();
}
}