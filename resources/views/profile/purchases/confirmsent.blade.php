@extends('master.confirmation')

@section('confirmation-title', 'Confirm ' . $sale-> short_id . ' is sent')

@section('confirmation-content')
    Confirm that you have sent <strong>{{ $sale -> quantity }} X {{ $sale -> offer -> product -> name }}</strong>?
    <br>
    Purchase ID: {{ $sale -> short_id }}

@endsection

@section('confirmation-back', $backRoute)
@section('confirmation-next', route('profile.sales.sent', $sale))
