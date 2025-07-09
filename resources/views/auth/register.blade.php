@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-white py-2">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    <img src="{{ url('images/logo.png') }}" class="mb-2 mx-auto" role="img" width="179"
                        height="101">

                    <div class="card-body">
                        <h3 class="text-center mb-2">Welcome To Our Community </h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                             <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-person"></i></span>
                                      <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                       placeholder="User Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                         placeholder="example@example.com"   autofocus aria-label="Username" aria-describedby="basic-addon1">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="input-group mb-3 col-6">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                           placeholder="Enter password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="input-group mb-3 col-6">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-shield-lock"></i></span>
                                        <input id="password-confirm" type="password" class="form-control"
                                       placeholder="confirm password"  name="password_confirmation" required autocomplete="new-password">
                                       
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
