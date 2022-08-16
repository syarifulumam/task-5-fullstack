<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        return view('pages.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('pages.posts.create', compact('categories'));
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
        
        return redirect('posts');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::get();
        return view('pages.posts.edit', compact(['post','categories']));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $requestPost = $request->all();
        if ($request->hasFile('image')) {
            if ($post->image != null) {
                Storage::disk('public')->delete('thumbnails/'. $post->image);
            }
            $fileName = $request->image->getClientOriginalName();
            $requestPost['image'] = $fileName;
            $request->image->storeAs('public/thumbnails', $fileName);
        }

        Post::findOrFail($id)->update($requestPost);
        
        return redirect('posts');

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public')->delete('thumbnails/'. $post->image);
        $post->delete();
        return back();
    }
}
