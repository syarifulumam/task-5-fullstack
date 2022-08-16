<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return redirect('category');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        Category::findOrFail($id)->update($request->all());
        return redirect('category');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back();
    }
}
