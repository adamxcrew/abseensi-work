@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="container mt--9 pb-5">
        <div class="row justify-content-end">
            <div class="col-lg-5 col-md-7">
                <div class="container-form">
                    <div class="card-body">
                        <form role="form" action="{{ route('login.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control" name="email" placeholder="Email" type="email"
                                        value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">*{{ $message }} <i class="fas fa-arrow-up"></i>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" type="password"
                                        value="{{ old('password') }}" id="password">
                                    <div class="input-group-prepend">
                                        <button type="button" onclick="seePassword(this)" class="input-group-text"
                                            id="seePass"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">*{{ $message }} <i class="fas fa-arrow-up"></i>
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <a class="font-lupa" href="#">Lupa Kata Sandi?</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-masuk">Sign in</button>
                            </div>
                            <div class="d-flex">
                                <div class="mr-auto">
                                    <div class="container-check">
                                        <input class="checkbox" type="checkbox">
                                        <label class="check-label" for="ingat-saya">
                                            Ingat Saya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
