@extends('master.signinmain')


@section('title','Sign in')

@section('content')

<div class="card mx-auto" style="width: 18rem;">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-auto my-1 py-2">
            <div class="mt-3 text-center">
            <img src="/svg/logo.svg" width="100" height="100" class="d-inline-block align-top" alt="">
            <h2>Welcome</h2>
            </div>

            <div class="mt-3">
                <form action="{{ route('auth.signin.post') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="username"><i class="fas fa-user"></i> Username</label>
                        <input type="text" class="form-control @error('username',$errors) is-invalid @enderror" placeholder="Username" name="username" id="username">
                        @error('username',$errors)
                            <p class="text-danger">{{$errors->first('username')}}</p>
                        @enderror
                    </div>

                    <div class="form-group py-2">
                        <label for="password"><i class="fas fa-key"></i> Password</label>
                        <input type="password" class="form-control @error('password',$errors) is-invalid @enderror" placeholder="Password" name="password"
                               id="password">
                        @error('password',$errors)
                        <p class="text-danger">{{$errors->first('password')}}</p>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <div class="row">
                            <div class="col-md-auto offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </div>
                    @include('includes.flash.error')

                </form>
            </div>
                <div class="mt-3 text-center">
                    Forgot your password?
                    <a href="/forgotpassword" style="text-decoration: none">Reset it here
                    </a>
                </div>
                <div class="mt-3 text-center">
                    Don't have an account?
                    <a href="/signup" style="text-decoration: none">Sign up here
                    </a>
                </div>
        </div>
    </div>
  </div>

@stop
