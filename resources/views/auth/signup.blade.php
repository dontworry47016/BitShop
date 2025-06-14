@extends('master.signinmain')


@section('title','Sign Up')

@section('content')
<div class="card mx-auto" style="width: 18rem;">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-auto my-1 py-2 text-center">
            <h2><i class="fas fa-user-plus"></i></h2>
            <small>Register</small>

            <div class="mt-3 text-center">
                <form action="{{route('auth.signup.post')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group ">
                        <label for="username"><i class="fas fa-user"></i> Username</label>
                        <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" placeholder="Username" name="username" id="username">
                        @if($errors->has('username'))
                            <p class="text-danger">{{$errors->first('username')}}</p>
                        @endif
                    </div>
                    <div class="form-row py-2">
                        <div class="col">
                            <label for="password"><i class="fas fa-key"></i> Password</label>
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Password" name="password"
                                   id="password">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Confirm Password"
                                   name="password_confirmation" id="password_confirm">
                        </div>

                    </div>
                    @if($errors->has('password'))
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    @endif
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Referral:</div>
                            </div>
                            <input type="text" name="refid" value="{{$refid}}" class="form-control" placeholder="#XXXXXX"
                                   @if($refid !== '') readonly @endif>
                        </div>

                    </div>
                    @include('includes.captcha')
                    @if($errors->has('captcha'))
                        <p class="text-danger">{{$errors->first('captcha')}}</p>
                    @endif
                    <div class="form-group py-2">
                        <div class="row">
                            <div class="col-md-auto offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{route('auth.signin')}}" class="text-muted">Already have an account?</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
        </div>


@stop
