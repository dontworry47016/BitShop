@extends('master.profile')

@section('profile-content')
    @include('includes.flash.error')
    @include('includes.flash.success')

    <h1 class="my-3 text-center">Settings</h1>

    <h3 class="mt-4">Profile Picture</h3>
    <hr>
    <div class="row">
        <div class="col-md-6">
            @if(Auth::user()->image)
               <img class="image rounded-circle" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="No profile picture has been set." style="width: 40px;height: 40px; padding: 0px; margin: 0px; ">
            @endif
        </div>
        <div class="col-md-6 text-right">
           <form action="{{route('profile.picture')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="file" name="image">
              <input type="submit" value="Upload">
           </form>
        </div>
    </div>
    
    <h3 class="mt-4">Notifications</h3>
    <hr>
    <form action="{{route('profile.notifications.delete')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-red"><i class="fa fa-trash"></i> Clear notifications
            </button>
        </div>
    </form>
    
    <h3 class="mt-4">Two Factor Authentication</h3>
    <hr>
    <div class="row">
        <div class="col-md-6 text-left">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('profile.2fa.change', 0) }}" class="btn @if(auth() -> user() -> login_2fa == false) btn-red @else btn-green @endif">Off</a>
                <a href="{{ route('profile.2fa.change', true) }}" class="btn @if(auth() -> user() -> login_2fa == true) btn-red @else btn-green @endif">On</a>
            </div>
        </div>
    </div>

    <h3 class="mt-4">Password</h3>
    <hr>
    <form action="{{ route('profile.password.change') }}" method="POST" class="justify-content-between">
        {{ csrf_field() }}
        <div class="form-row my-2">
            <label for="old_password" class="col-form-label col-md-2">Old password:</label>
            <div class="col-md-10">
                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password">
            </div>
        </div>
        <div class="form-row my-2">
            <label for="new_password" class="col-form-label col-md-2">New password:</label>
            <div class="col-md-5">
                <input type="password" class="form-control @error('new_password', $errors) is-invalid @enderror" id="new_password" name="new_password" placeholder="New password">
            </div>
            <div class="col-md-5">
                <input type="password" class="form-control @error('new_password', $errors) is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password">
            </div>
        </div>
        <div class="form-row text-right justify-content-between">
            <div class="col-md-9 text-left">
                @error('new_password', $errors)
                    <p class="invalid-feedback d-block">{{ $errors -> first('new_password') }}</p>
                @enderror
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" type="submit">Change password</button>
            </div>
        </div>
    </form>
    
    @if(\App\Marketplace\Utility\CurrencyConverter::isEnabled())
        @include('multicurrency::changeform')
    @endif

    <h3 class="mt-4">Payment Addresses</h3>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('profile.vendor.address') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-lg d-flex" name="address" id="address" placeholder="Address...">
                    </div>
                    <div class="col-md-2">
                        <select name="coin" id="coin" class="form-control form-control-lg d-flex">
                            <option>Coin</option>
                            @foreach(config('coins.coin_list') as $supportedCoin => $instance)
                                <option value="{{ $supportedCoin }}">{{ strtoupper(\App\Address::label($supportedCoin)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-primary btn-lg">Change</button>
                    </div>
                </div>
            </form>
            <p class="text-muted">Funds will be sent to your most recently added address for each type of coin.</p>


            @if(auth() -> user() -> addresses -> isNotEmpty())
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Coin</th>
                        <th class="text-right">Added</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(auth() -> user() -> addresses as $address)
                        <tr>
                            <td>
                                <input type="text" readonly class="form-control" value="{{ $address -> address }}">
                            </td>
                            <td><span class="badge badge-primary">{{ strtoupper($address -> coin) }}</span></td>
                            <td class="text-muted text-right">
                                {{ $address -> added_ago }}
                            </td>
                            <td class="text-right"><a href="{{ route('profile.vendor.address.remove', $address) }}" class="btn btn-red"><i class="fa fa-trash mr-1"></i>Remove</a></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            @else
                <div class="alert text-center alert-warning">No payment addresses.</div>
            @endif
        </div>
    </div>

    <h3 class="mt-4">Your referral link</h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <input type="url" readonly class="form-control disabled" value="{{ route('auth.signup', auth() -> user() -> referral_code) }}">
        </div>
    </div>
    
    <h3 class="mt-4">Sign out</h3>
    <hr>
        <form class="form-inline" action="{{route('auth.signout.post')}}" method="post">
        {{csrf_field()}}
        <button class="btn btn-primary d-block" type="submit" style="text-decoration: none;">Sign Out</button>
        </form>

@stop
