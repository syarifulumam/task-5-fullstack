@extends('layouts.app')

@section('content')
    <div class="container center">
        <div class="row">
            <div class="col">
                <img src="{{ asset('thumbnails/'.$post->image) }}" alt="" class="img-fluid mx-auto">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection