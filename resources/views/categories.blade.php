@extends('layout.main')

@section('container')

    <h2 class="mt-4 mb-3 text-center"> All Categories </h2>
    
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-lg-4">
                <a href="/posts?category={{$category->slug}}">
                    <div class="card bg-dark text-white">
                        <img src="https://source.unsplash.com/400x400?{{$category->name}}" class="card-img" alt="{{$category->name}}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h3 class="card-title text-center flex-fill fw-bold">{{$category->name}}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
    
