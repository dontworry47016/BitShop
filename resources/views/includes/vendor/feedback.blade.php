<div class="row">
    <div class="col">
        <h5 class="mb-3">Average ratings</h5>
    </div>
    <div class="col text-md-right">
        <a href="{{route('vendor.show.feedback',['user'=>$vendor])}}">See all feedback</a>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6">
        <span>Quality:</span><br>
        <span>Communication:</span><br>
        <span>Shipping:</span>
    </div>
    <div class="col-md-4 col-sm-6">
        <span>
            @include('includes.purchases.stars', ['stars' => $vendor -> vendor -> roundAvgRate('quality_rate')]) ({{ $vendor -> vendor -> avgRate('quality_rate') }})
        </span>
        <span> <br>
            @include('includes.purchases.stars', ['stars' => $vendor -> vendor -> roundAvgRate('communication_rate')]) ({{ $vendor -> vendor -> avgRate('communication_rate') }})
        </span> <br>
        <span>
            @include('includes.purchases.stars', ['stars' => $vendor -> vendor -> roundAvgRate('shipping_rate')]) ({{ $vendor -> vendor -> avgRate('shipping_rate') }})
        </span>
    </div>
    <div class="col-md-5 mt-sm-3">

        <div class="row text-md-center">
            <div class="col-4">
                <span class="fas fa-thumbs-up text-success"></span> {{$vendor->vendor->countFeedbackByType('positive')}}
            </div>
            <div class="col-4">
                <span class="fas fa-minus text-secondary"></span> {{$vendor->vendor->countFeedbackByType('neutral')}}
            </div>
            <div class="col-4">
                <span class="fas fa-thumbs-down text-danger"></span> {{$vendor->vendor->countFeedbackByType('negative')}}
            </div>
        </div>
    </div>


</div>

