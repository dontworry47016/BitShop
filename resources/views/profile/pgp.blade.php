@extends('master.profile')

@section('profile-content')
    @include('includes.flash.success')

    <div class="row">
        <div class="col-md-6">
            <h3 class="mb-3">Current PGP key</h3>
            <hr>

            @if(auth() -> user() -> hasPGP())
                <p>Your PGP key is:</p>
                <textarea class="disabled form-control" style="resize: none" rows="10" disabled>{{{ auth() -> user() -> pgp_key }}}</textarea>
            @else
                <div class="alert alert-warning text-center my-3">
                    You don't have a PGP key set.
                </div>
            @endif
            <p class="text-center"><a href="{{ route('profile.pgp.old') }}">Old PGP keys</a></p>

        </div>
        <div class="col-md-6">
            <h3 class="mb-3">New PGP key</h3>
            <hr>

            <form method="POST" action="{{ route('profile.pgp.post') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="mb-3" for="newpgp">Enter <strong>public</strong> key here:</label>
                    <textarea name="newpgp" id="newpgp" style="resize: none" rows="10" class="form-control @error('newpgp', $errors) is-invalid @enderror"></textarea>
                    @error('newpgp', $errors)
                    <div class="invalid-feedback">
                        {{ $errors -> first('newpgp') }}
                    </div>
                    @enderror
                    <p class="text-muted text-center"><strong>PUBLIC KEY ONLY</strong></p>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Add PGP</button>
                </div>

            </form>
        </div>
    </div>




@stop
