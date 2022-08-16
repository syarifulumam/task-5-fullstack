<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->simplePaginate(5);
        return response()->json([
            "message" => "Request Success",
            "Data" => $posts
        ],200);
    }

    public function store(PostRequest $request)
    {
        $requestData = $request->all();
        if ($request->hasFile('image')) {
            $fileName = $request->image->getClientOriginalName();
            $requestData['image'] = $fileName;
            $request->image->storeAs('public/thumbnails', $fileName);
        }
        Auth::user()->post()->create($requestData);
        
        return response()->json(["Message" => "Add Data Success", "data" => $requestData], 201);
    }

    public function show(Post $post)
    {
        return response()->json(["Message" => "Request Success", "data" => $post], 200);
    }

    public function update(PostRequest $request, Post $post)
    {
        $requestPost = $request->all();
        if ($request->hasFile('image')) {
            if ($post->image != null) {
                Storage::disk('public')->delete('thumbnails/'. $post->image);
            }
            $fileName = $request->image->getClientOriginalName();
            $requestPost['image'] = $fileName;
            $request->image->storeAs('public/thumbnails', $fileName);
        }

        $post->update($requestPost);
        
        return response()->json(["Message" => "Success", "data" => $requestPost], 200);

    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete('thumbnails/'. $post->image);
        $post->delete();
        return response()->json(null, 204);
    }
}
