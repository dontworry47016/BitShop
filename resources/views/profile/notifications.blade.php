@extends('master.profile')

@section('title', 'Notifications')

@section('profile-content')
    @include('includes.flash.success')
    @include('includes.flash.error')

    <form action="{{route('profile.notifications.delete')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-red"><i class="fa fa-trash"></i> Clear notifications
            </button>
        </div>
    </form>
    <table class="table table-hover">
        <thead>
        <th>Notification</th>
        <th>Time</th>
        <th>Action</th>
        </thead>
        @foreach($notifications as $notification)
            <tr>
                <td>
                    {{$notification->description}}
                </td>
                <td>
                    {{$notification->created_at->diffForHumans()}}
                </td>
                <td>
                    @if($notification->getRoute() !== null )
                        <a href="{{route($notification->getRoute(),$notification->getRouteParams())}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                    @else
                        None
                    @endif
                </td>
            </tr>

        @endforeach
    </table>
    <div class="mt-3">
        {{$notifications->links('includes.paginate')}}
    </div>

@stop
