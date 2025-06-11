@extends('master.main')

@section('title', 'Profile settings')

@section('content')

    <div class="row">
        <div class="col-lg-2">
            @include("includes.profile.menu")
        </div>
<div class="col-lg-10">
    @yield("profile-content")
</div>

</div>


@stop
