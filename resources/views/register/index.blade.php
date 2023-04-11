@extends('layout.main')

@section('container')
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6">
            <main class="form-register">

                <form action="/register" method="post">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center fw-bold mb-3">Form Registration</h1>
                
                    <div class="form-floating">
                        <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="name@example.com" name="name" value="{{old('name')}}" required>
                        <label for="name">Name</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="name@example.com" name="username" value="{{old('username')}}" required>
                        <label for="username">UserName</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value="{{old('email')}}" required>
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-dark text-warning mt-3" type="submit">Register</button>
                    <small class="d-block text-center mt-2">Already registered?<a class="text-decoration-none" href="/login"> Login-here </a></small>
                </form>

            </main>
        </div>
    </div>
@endsection