@extends('layout.main')

@section('container')
    <h2 class="mt-4"> Ini Halaman About </h2>
    <h4>Nama : {{$name}} </h4>
    <p>Email : {{$email}} </p>
    <img src="img/ai.png" width="200 px" alt="">
@endsection