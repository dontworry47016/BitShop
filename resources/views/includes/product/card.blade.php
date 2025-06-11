<div class="card">
    <img class="card-img-top" src="{{ asset('storage/'  . $product -> frontImage() -> image) }}" alt="{{ $product -> name }}" loading="lazy" />
    <div class="card-body">
        <a href="{{ route('product.show', $product) }}"><h5 class="card-title text-center" style="font-size: 14px;">{{ \Illuminate\Support\Str::limit($product -> name, 20) }}</h5></a>
        <p class="card-subtitle text-center" style="font-size: 12px;">{{ $product -> category -> name }}</p>
        <p class="card-subtitle text-center" style="font-size: 12px;">From: <strong>{{ \App\Marketplace\Utility\CurrencyConverter::getLocalSymbol() }}{{ $product->getLocalPriceFrom() }}</strong></p>
        <p class="card-subtitle text-center" style="font-size: 12px;">Stock: <strong>{{ $product -> quantity }}</strong></p>
        <p class="card-text text-center">
            <a href="{{ route('vendor.show', $product -> user) }}" style="font-size: 14px;"><img class="image rounded-circle" src="{{asset('/storage/images/'.$product->user->image)}}" alt="" style="width: 20px; height: 20px; padding: 0px; margin: 0px; "> {{ $product -> user -> username }}</a>
        </p>
        
    </div>
    <div class="card-footer">
   <a href="{{ route('product.show', $product) }}" class="btn btn-primary d-block">Buy now</a>
   </div>

</div>
