<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    
    
    public function index()
    {
        $query = Task::where('user_id', Auth::id());

        if (request()->has('status')) {
            if (request('status') === 'completed') {
                $query->where('is_completed', true);
            } elseif (request('status') === 'pending') {
                $query->where('is_completed', false);
            }
        }

        if (request()->has('search') && request('search') !== '') {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        $tasks = $query->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_completed' => false,
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'] ?? null,
        ]);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $this->authorize('update', $task);
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Görev güncellendi.');
    }

    public function destroy(Task $task)
    {
    
        $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function complete(Task $task)
    {
        $this->authorize('complete', $task);

        $task->is_completed = true;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Görev tamamlandı.');
    }
}