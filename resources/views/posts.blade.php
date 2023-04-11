@extends('layout.main')

@section('container')

<h2 class="mt-3 text-center"> {{$title}} </h2>

{{-- searching --}}
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-sm-6">

        <form action="/posts">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Type here to search" name="search" value="{{request("search")}}">
                <button class="btn btn-warning" type="submit">Search</button>
            </div>

            @if (request('category'))
            <input type="hidden" class="form-control" placeholder="Type here to search" name="category" value="{{request("category")}}">
            @endif

            @if (request('user'))
            <input type="hidden" class="form-control" placeholder="Type here to search" name="user" value="{{request("user")}}">
            @endif

        </form>

        </div>
    </div>
{{-- ============================ --}}


    @if ($posts->count() > 0)

    <div class="card mb-3 mt-3">
        @if( $posts[0]->image )
        <div style="max-height: 600px; overflow:hidden">
            <img src="{{asset('storage/'. $posts[0]->image)}}" class="card-img-top" alt="{{$posts[0]->category->name}}">
        </div>
        @else 
            <img src="https://source.unsplash.com/1200x400?{{$posts[0]->category->name}}" class="card-img-top" alt="{{$posts[0]->category->name}}">
        @endif
        <div class="card-body text-center">
            <h3 class="card-title">{{$posts[0]->title}}</h3>
            <small>
                <p>By : <a href="/posts?user={{$posts[0]->user->username}}" class="text-decoration-none"> {{$posts[0]->user->name}} </a> in <a href="/posts?category={{$posts[0]->category->slug}}" class="text-decoration-none"> {{$posts[0]->category->name}} </a> {{$posts[0]->created_at->diffForHumans()}} </p>
            </small>
            <p class="card-text"> {{$posts[0]->excerpt}} </p>
            <p class="mt-2"> <a class="text-decoration-none btn btn-warning" href="/posts/{{$posts[0]->slug}}"> Read More </a> </p>
        </div>
    </div>

    <div class="row">

        @foreach ($posts->skip(1) as $post)
        <div class="col-lg-4">
            <div class="card mb-5">

                {{-- Category --}}
                <div class="position-absolute py-2 px-3" style="background-color: rgba(0, 0, 0, 0.6)"><a class="text-decoration-none text-white" href="/posts?category={{$post->category->slug}}"> {{$post->category->name}} </a></div>

                @if( $post->image )
                    <img src="{{asset('storage/'. $post->image)}}" alt="{{$post->name}}" class="img-fluid">
                @else 
                    <img src="https://source.unsplash.com/400x400?{{$post->category->name}}" class="card-img-top" alt="{{$post->category->name}}">
                @endif
                <div class="card-body">
                    <h3> <a class="text-decoration-none text-dark" href="/posts/{{$post->slug}}"> {{$post->title}} </a> </h3>
                    <p>By : <a href="/posts?user={{$post->user->username}}" class="text-decoration-none"> {{$post->user->name}} </a> {{$post->created_at->diffForHumans()}} </p>
                    <p> {{$post->excerpt}} </p>
                    <a class="text-decoration-none btn btn-warning" href="/posts/{{$post->slug}}">Read More</a>
                </div>
            </div>
        </div>

        @endforeach

    </div>

    @else
        <div class="text-center"> <p class=" fs-3">No posts here</p> </div>
    @endif

    {{$posts->links()}}

@endsection
    
