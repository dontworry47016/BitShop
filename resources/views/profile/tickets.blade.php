@extends('master.profile')

@section('content')

    <div class="row">

            @include('includes.flash.error')
            @include('includes.flash.invalid')

        <div class="col-md-3">
            <h3 class="mb-2 text-center">Tickets</h3>

            <a href="{{ route('profile.tickets') }}" class="btn btn-block @if($ticket) btn-primary @else btn-primary @endif my-2">
                <i class="fas fa-plus-circle mr-2"></i>
                New ticket
            </a>

            @if(auth() -> user() -> tickets() -> exists())
                <div class="list-group flex-md-column flex-row nav-pills justify-content-sm-center">
                @foreach(auth() -> user() -> tickets as $currTicket)
                    <a href="{{ route('profile.tickets', $currTicket) }}" class="list-group-item list-group-item-action @if($currTicket == $ticket) active @endif">
                        {{ $currTicket -> title }}
                        @if($currTicket -> solved)
                            <span class="badge badge-success">Solved</span>
                        @else
                            @if($currTicket -> answered)
                                <span class="badge badge-warning">Answered</span>
                            @endif
                        @endif

                    </a>
                @endforeach
                </div>
            @else
                <div class="alert alert-primary text-center">
                    You don't have any tickets.
                </div>
            @endif

        </div>
        <div class="col-md-9">
            @if($ticket)
                @include('includes.profile.ticket')
            @else
                @include('includes.profile.newticket')
            @endif
        </div>
    </div>

@stop
