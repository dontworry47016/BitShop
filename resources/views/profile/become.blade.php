@extends('master.profile')

@section('profile-content')
    @include('includes.flash.error')
    @include('includes.flash.success')

    <h1 class="my-3 text-center">Become a Vendor</h1>

    <p class="my-3 text-center">To become a vendor pay <strong>{{ $vendorFee }} USD</strong> to either of the following addresses.</p>

    <p class="my-3"></p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Coin</th>
                <th>Address</th>
                <th>Vendor Fee</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($depositAddresses as $depositAddress)
            <tr>
                <td>
                    <span class="badge badge-info">{{ strtoupper($depositAddress -> coin) }}</span>
                </td>
                <td>
                    <input type="text" readonly class="form-control" value="{{ $depositAddress -> address }}"/>
                </td>
                <td class="text">
                    <span class="badge badge-primary">{{ $depositAddress -> target }}</span>
                </td>
                <td class="text">
                    @if($depositAddress -> isEnough())
                        <span class="badge badge-primary">Enough funds</span>
                    @endif
                    <span class="badge badge-info">{{ $depositAddress -> balance }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <form action="{{ route('profile.vendor.become') }}" class="form-inline">
        <button type="submit" class="btn btn-lg btn-primary">
            <i class="fas fa-file-signature mr-2"></i>
            Become a Vendor
        </button>
    </form>

@stop
