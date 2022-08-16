@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary mb-2">Kembali</a>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" name="title" value="{{ old('title',$post->title) }}" class="form-control" id="title">
                      @error('title')
                        <span class="text-sm text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="3"> {{ old('content',$post->content) }}</textarea>
                        @error('content')
                        <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="categories" aria-label="Default select example">
                            <option selected>-- Pilih Categories --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id === $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input class="form-control" name="image"  type="file" id="thumbnail">
                        @error('image')
                        <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection