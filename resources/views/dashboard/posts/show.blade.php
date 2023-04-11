@extends('dashboard.layouts.main')

@section('container')
        <div class="row justify-content-start mb-5">
                <div class="col-lg-6">
                        <h4 class="mt-3 mb-3"> {{$post->title}} </h4>
                        <div class="d-flex mb-3" >
                                <a href="/dashboard/posts" class="btn btn-info"><span data-feather="chevron-left"></span> Back to Posts</a>
                                <a href="{{route('posts.edit', $post->slug)}}" class="btn btn-warning mx-2"><span data-feather="edit"></span> Edit Post</a>
                                <form action="{{route('posts.delete', $post->slug)}}" method="post">
                                @method('delete')
                                @csrf
                                        <button type="submit" onclick="return confirm('Yakin tod?')" class="btn btn-danger border-1"><span data-feather="trash-2"></span> Delete Post</button>
                                </form>
                        </div>
                        @if( $post->image )
                        <div style="max-height: 400px; overflow:hidden">
                                <img src="{{asset('storage/'. $post->image)}}" alt="{{$post->name}}" class="img-fluid">
                        </div>
                        @else 
                                <img src="https://source.unsplash.com/1200x600?{{$post->category->name}}" alt="{{$post->name}}" class="img-fluid">
                        @endif
                        <p> {!! $post->body !!} </p>
                </div>
        </div>
        
@endsection