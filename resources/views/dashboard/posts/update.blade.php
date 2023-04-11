@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Post Form</h1>
    </div>

    <div class="col-lg-8 mb-5">

        <form enctype="multipart/form-data" action="{{route("posts.update", $post->slug)}}" method="post">
            @method('put')
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="title" name="title" value="{{old("title", $post->title)}}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="slug" name="slug" value="{{old("slug", $post->slug)}}">
                @error('slug')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" aria-label="Default select example" name="category_id">
                @foreach ($categories as $category)

                    @if(old("category_id", $post->category_id) == $category->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif

                @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                @if($post->image)
                    <img src="{{asset('storage/'. $post->image)}}" class="img-preview img-fluid mb-3 d-block" width="200px">
                @else
                    <img class="img-preview img-fluid mb-3" width="200px">
                @endif
                <input class="form-control" type="file" id="image" name="image" @error('image') is-invalid @enderror onchange="previewImage()">
                @error('image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Body</label>
                @error('body')
                <small class="text-danger d-block">
                    {{$message}}
                </small>
                @enderror
                <input id="x" type="hidden" name="body" value="{{old("body", $post->body)}}">
                <trix-editor input="x"></trix-editor>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-dark text-warning border-0 mt-2">Update Post</button>
            </div>
        </form>

    </div>

    <script>
        function previewImage(){

            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection