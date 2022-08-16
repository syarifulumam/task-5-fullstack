<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->simplePaginate(5);
        return response()->json([
            "message" => "Request Success",
            "Data" => $categories
        ],200);
    }


    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json(["Message" => "Add Data Success", "data" => $category], 201);
    }

    public function show(Category $category)
    {
        return response()->json(["Message" => "Request Success", "data" => $category], 200);
    }


    public function update(Category $category, CategoryRequest $request)
    {
        $category->update($request->all());
        return response()->json(["Message" => "Success", "data" => $category], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
