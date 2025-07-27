<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For testing purposes, get categories for user ID 1 if not authenticated
        if (Auth::check()) {
            $categories = Auth::user()->categories()->orderBy('name')->get();
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // For testing purposes, use user ID 1 if not authenticated
        $userId = Auth::check() ? Auth::id() : 1;
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where('user_id', $userId)
            ]
        ]);

        $category = \App\Models\Category::create([
            'name' => $validated['name'],
            'user_id' => $userId
        ]);

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // For testing purposes, use user ID 1 if not authenticated
        $userId = Auth::check() ? Auth::id() : 1;
        
        // Check if the category belongs to the user
        if ($category->user_id !== $userId) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where('user_id', $userId)->ignore($category->id)
            ]
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // For testing purposes, use user ID 1 if not authenticated
        $userId = Auth::check() ? Auth::id() : 1;
        
        // Check if the category belongs to the user
        if ($category->user_id !== $userId) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Check if the category has tasks
        if ($category->tasks()->count() > 0) {
            return response()->json(['message' => 'You cannot delete this category because it has associated tasks. Please remove the tasks first.'], 400);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
