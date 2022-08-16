@extends('layouts.app')

@section('content')
    <div class="container">
        <a type="button" class="btn btn-secondary mb-2" href="{{ url()->previous() }}">Kembali</a>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('category.update',$category->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                      <label for="name" class="form-label" >Name</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$category->name) }}">
                      @error('name')
                        <span class="text-sm text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection