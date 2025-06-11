@extends('master.confirmation')

@section('confirmation-title', 'Mark recieved - ' . $purchase-> short_id)

@section('confirmation-content')
    This action can't be undone! Confirm that <strong>{{ $purchase -> quantity }} X {{ $purchase -> offer -> product -> name }}</strong> has been recieved?
    <br>
    Purchase ID: {{ $purchase -> short_id }}
@endsection

@section('confirmation-back', $backRoute)
@section('confirmation-next', route('profile.purchases.delivered', $purchase))
