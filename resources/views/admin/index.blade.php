@extends('master.admin')

@section('admin-content')

    <h1 class="mb-3">Market Statistics</h1>
  <div class="row mt-3 my-2">
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Number of products in market</h5>
       <p class="card-text">{{ $total_products }}</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Times someone bought a products from market</h5>
       <p class="card-text">{{ $total_purchases }}</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Number of users registered in market</h5>
       <p class="card-text">{{ $total_users }}</p>
     </div>
    </div>

    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Number of vendors on this market</h5>
       <p class="card-text">{{ $total_vendors }}</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Average product price</h5>
       <p class="card-text">@include('includes.currency', ['usdValue' => round($avg_product_price,2)])</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Total money spent on this market</h5>
       <p class="card-text">@include('includes.currency', ['usdValue' => round($total_spent)])</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Purchases in last 24h</h5>
       <p class="card-text">{{ $total_daily_purchases }}</p>
     </div>
    </div>
    
    <div class="card my-2" style="width: 18rem;">
     <div class="card-body">
       <h5 class="card-title">Purchases in last 24h</h5>
        <table class="table table-borderless">
          @foreach($total_earnings_coin as $coin => $total_sum)
           <tr>
            <td><span class="badge badge-primary">{{ strtoupper(\App\Purchase::coinDisplayName($coin)) }}</span></td>
            <td class="text-right">{{ number_format(round($total_sum, 8), 8) }}</td>
           </tr>
          @endforeach
        </table>
     </div>
    </div>
  </div>


@stop
