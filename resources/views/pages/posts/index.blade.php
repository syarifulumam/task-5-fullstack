@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-primary mb-2">Tambah Data</a>
        <table class="table table-bordered bg-white">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($posts as $post)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="col-2"><img src="{{ asset('thumbnails/' . $post->image) }}" alt="" class="img-fluid"></td>
                <td class="col-3">{{ $post->title }}</td>
                <td class="col-3">{{ $post->content }}</td>
                <td class="col-1">{{ $post->category->name }}</td>
                <td class="col-3">
                    <a href="{{ route('posts.show', $post->id) }}" type="button" class="btn btn-primary">view</a>
                    <a href="{{ route('posts.edit', $post->id) }}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy',$post->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button type="submit" title="hapus data" class="btn btn-danger">Delete</button>
                    </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
    </div>
@endsection