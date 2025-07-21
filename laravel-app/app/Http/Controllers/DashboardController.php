<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index() 
    {
        $total = Task::count();
        $completed = Task::where('is_completed', true)->count();
        $pending = Task::where('is_completed', false)->count();
        $latestTasks = Task::latest()->take(5)->get();

        return view('dashboard', compact('total', 'completed', 'pending', 'latestTasks'));
    }
}
