<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\StoreRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('dashboard.category.index', compact('categories'));
    }

    public function search()
    {
        $search = request('search');
        $categoriesSearch = Category::query()
            ->where('name', 'LIKE', "%{$search}%");

        $categoriesSearch = $categoriesSearch->paginate(5);
        return view('dashboard.category.search', compact('categoriesSearch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('category.index')->with('session', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('category.index')->with('session', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('session', 'Category deleted successfully');
    }
}
