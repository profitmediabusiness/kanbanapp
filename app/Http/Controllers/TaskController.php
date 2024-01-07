<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TaskController extends Controller
{


    public function __construct()
    {
    }

public function index()
{
    $pageTitle = 'Task List'; 
    // $tasks = $this->tasks;
    $tasks = Task::all();
    return view('tasks.index', [
        'pageTitle' => $pageTitle, 
        'tasks' => $tasks,
    ]);
}

public function edit($id)
{
    $pageTitle = 'Edit Task';
    // $tasks = $this->tasks;
    $task = Task::find($id);

    // $task = $tasks[$id - 1];

    return view('tasks.edit', ['pageTitle' => $pageTitle, 'task' => $task]);
}

public function create()
{
    $pageTitle = 'create Task';

    return view('tasks.create', ['pageTitle' => $pageTitle, ]);
}

public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],
            $request->all()
        );

        Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'due_date' => 'required',
                'status' => 'required',
            ],
            $request->all()
        );
        $task = Task::find($id);
        $task->update([
            // data task yang berasal dari formulir
            'name' => $request->name,
            'detail' => $request->detail,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
        // Code untuk melakukan redirect menuju GET /tasks
        
    }

    public function delete($id)
{
    // Menyebutkan judul dari halaman yaitu "Delete Task"
    //  Memperoleh data task menggunakan $id
    // Menghasilkan nilai return berupa file view dengan halaman dan data task di atas 
    $pageTitle = 'Delete Task';
        $task = Task::find($id);
        if(Gate::allows('performAsTaskOwner', $task)||Gate::allows('deleteAnyTask', Task::class)) {
        } else{
            return redirect()->route('home');
        }
        Gate::authorize('delete', $task);

        return view('tasks.delete', ['pageTitle' => $pageTitle, 'task' => $task]);
}
public function destroy($id)
{
    $task = Task::find($id);
    $task->delete();
    // Melakukan redirect menuju tasks.index
    return redirect()->route('tasks.index');

}
}