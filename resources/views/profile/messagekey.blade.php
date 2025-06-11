@extends('master.profile')

@section('profile-content')
    @include('includes.flash.error')
    @include('includes.flash.success')
    @include('includes.validation')


    <h1 class="my-3 text-center">Decrypt messages</h1>
    <hr>
    <div class="row justify-content-center">
       <div class="col-md-12 text-center">
           <p>All your messages are PGP encrypted. Enter your password to unlock your PGP key for this session.</p>
       </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('profile.messages.decrypt.post')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="password" name="password" class="form-control" >
                </div>
                <div class="form-group text-center py-2">
                    <button class="btn  btn-green" type="submit">Decrypt messages</button>
                </div>
            </form>
        </div>


    </div>



@stop
