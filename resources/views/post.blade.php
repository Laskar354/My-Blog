@extends('layout.main')

@section('container')

        <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                        <h4 class="mt-3 mb-3"> {{$post->title}} </h4>
                        <p>By : <a href="/posts?user={{$post->user->username}}" class="text-decoration-none"> {{$post->user->name}} </a> in <a href="/posts?category={{$post->category->slug}}" class="text-decoration-none"> {{$post->category->name}} </a> </p>
                        @if( $post->image )
                        <div style="max-height: 600px; overflow:hidden">
                                <img src="{{asset('storage/'. $post->image)}}" alt="{{$post->name}}" class="img-fluid">
                        </div>
                        @else 
                                <img src="https://source.unsplash.com/1200x600?{{$post->category->name}}" alt="{{$post->name}}" class="img-fluid">
                        @endif
                        <p> {!! $post->body !!} </p>
                        <p class="mt-5"><a class="text-decoration-none" href="/posts"><i class="bi bi-arrow-return-left"></i> Back to All Posts</a></p>
                </div>
        </div>


@endsection
