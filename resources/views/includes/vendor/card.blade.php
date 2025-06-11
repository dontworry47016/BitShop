<div class="card mt-5 profile-card border border-secondary" >
    <div class="card-body">

        <div class="row">
                <h3><img class="image rounded-circle" src="{{asset('/storage/images/'.$vendor->image)}}" alt="" style="width: 40px; height: 40px; padding: 0px; margin: 0px; "><a href="{{ route('vendor.show', $vendor) }}" style="color: white"> {{ $vendor -> username }}</a> <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-red @endif active" style="cursor:default">Level {{$vendor->vendor->getLevel()}}</span></h3>
        </div>

        <div class="row">
            <div class="col-sm-3">
                @if($vendor->vendor->isTrusted())
                    <p class="badge badge-primary">Trusted vendor <span class="fa fa-check-circle"></span></p>
                @endif
                @if($vendor->vendor->isDwc())
                    <p class="badge badge-danger">Deal with caution <span class="fa fa-exclamation-circle"></span></p>
                @endif
            </div>
            <div class="col-sm-6 text-center">
                <p>
                    {{$vendor->vendor->about}}
                </p>
            </div>

        </div>
        
        @if($vendor -> hasPGP())
                <p>Vendor PGP:</p>
                <textarea class="disabled form-control" style="resize: none" rows="10" disabled>{{{ $vendor -> pgp_key }}}</textarea>
        @else
                <div class="alert alert-warning text-center my-3">
                    Vendor has no PGP key.
                </div>
        @endif
        
            <div class="col-sm-4 py-2">
                <p>
                    <a href="{{ route('profile.messages').'?otherParty='.$vendor->username}}" class="btn btn-primary"><span class="fas fa-envelope"></span> Send message</a></p>
            </div>
        
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('includes.vendor.feedback')
            </div>
        </div>

    </div>
</div>
