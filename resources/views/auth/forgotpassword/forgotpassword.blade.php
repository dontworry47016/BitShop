@extends('master.signinmain')


@section('title','Forgot Password')

@section('content')

    <div class="row mt-5 justify-content-center" >
        <div class="col-md-4 text-center">
            <h2>Forgot your password?</h2>
            <div class="alert alert-warning">
                You will become unable to view messages sent/recieved prior to password change.
            </div>
            <div class="mt-3">
                <p>How would you like to attempt recovery?</p>

                <form method="GET" action="/forgotpassword/pgp">
                    <div class="form-group text-center">
                        <div class="row">
                            <button type="submit" class="btn btn-outline-primary btn-block">PGP</button>
                        </div>
                    </div>
                </form>

                <form method="GET" action="/forgotpassowrd/mnemonic">
                    <div class="form-group text-center">
                        <div class="row">
                            <button type="submit" class="btn btn-outline-primary btn-block">Mnemonic</button>
                        </div>
                    </div>
                </form>
                <div class="form-group text-center">
                        <a href="{{route('auth.signin')}}" class="text-muted">Cancel</a>
                    </div>

            </div>
        </div>
    </div>

@stop
