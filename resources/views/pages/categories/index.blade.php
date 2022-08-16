@extends('layouts.app')

@section('content')
    <div class="container">
        <a type="button" class="btn btn-primary mb-2" href="{{ route('category.create') }}">Tambah Data</a>
        <table class="table table-bordered bg-white">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $categori)
              <tr>
                <th>{{ $loop->iteration }}</th>
                <td class="col-9">{{ $categori->name }}</td>
                <td class="col-3">
                    <a href="{{ route('category.edit', $categori->id) }}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('category.destroy',$categori->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method("DELETE")
                      <button type="submit" title="hapus data" class="btn btn-danger">Delete</button>
                    </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
    </div>
@endsection