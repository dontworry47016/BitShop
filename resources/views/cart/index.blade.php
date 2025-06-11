@extends('master.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-3"><i class="fas fa-cart-shopping mr-2"></i> {{ $numberOfItems }}</h2>
            @include('includes.flash.error')
        </div>

        </div>
@if(!empty($items))
    
@php
$convarray = collect($items);
@endphp     
@foreach($convarray->chunk(4) as $chunks)
  <div class="row mt-3 my-2">
    @foreach($chunks as $productId => $item)
      <div class="card mx-auto" style="width: 18rem;">
        <div class="col-md-auto my-1 py-2">
            <form action="{{ route('profile.cart.add', \App\Product::find($productId)) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-md-auto text-center">
                        <a class="text-center" href="{{ route('product.show', $item -> offer -> product) }}">
                            <h4>{{ $item -> offer -> product -> name }}</h4>
                        </a>
                        <a href="{{ route('vendor.show', $item -> offer -> product -> user) }}">
                           {{ $item -> vendor -> user -> username }}
                        </a>
                    </div>

                    <div class="col-md-auto  d-flex align-items-center justify-content-center my-1">
                        @if(count($item -> offer -> product -> getCoins()) > 1)
                        <select name="coin" id="coin" class="form-control form-control-sm">
                            @foreach($item -> offer -> product -> getCoins() as $coin)
                                <option value="{{ $coin }}" {{ $coin == $item -> coin_name ? 'selected' : ''}} >{{ strtoupper(\App\Purchase::coinDisplayName($coin)) }}</option>
                            @endforeach
                        </select>
                        @elseif(count($item -> offer -> product -> getCoins()) == 1)
                            <input type="hidden" name="coin" value="{{ $item -> offer -> product -> getCoins()[0] }}">
                            <input type="text" value="{{ strtoupper(\App\Purchase::coinDisplayName($item -> offer -> product -> getCoins()[0])) }}" class="form-control form-control-sm disabled" disabled>
                        @endif


                    </div>
                    <div class="col-md-auto d-flex align-items-center my-1">
                        <input type="number" class="form-control form-control-sm" name="amount" id="amount" min="1" max="{{ $item -> offer -> product -> quantity }}" placeholder="Quantity" value="{{ $item -> quantity }}"/>
                    </div>
                    <div class="col-md-auto text-center my-1">
                        @if($item -> offer -> product -> isPhysical())
                        <select name="delivery" id="delivery" class="form-control form-control-sm">
                            @foreach($item -> offer -> product -> specificProduct() -> shippings as $shipping)
                                <option value="{{ $shipping -> id }}" @if($shipping -> id == $item -> shipping -> id) selected @endif>{{ $shipping -> long_name }}</option>
                            @endforeach
                        </select>
                        @else
                        <span class="badge badge-info">Digital delivery</span>
                        @endif
                            <br>
                        @if(count($item -> offer -> product -> getTypes()) > 1)
                        <select name="type" id="type" class="form-control form-control-sm">
                            @foreach($item -> offer -> product -> getTypes() as $type)
                                <option value="{{ $type }}" {{ $type == $item -> type ? 'selected' : ''}} >{{ \App\Purchase::$types[$type] }}</option>
                            @endforeach
                        </select>
                        @elseif(count($item -> offer -> product -> getTypes()) == 1)
                            <input type="hidden" name="type" value="{{ $item -> offer -> product -> getTypes()[0] }}">
                            <input type="text" value="{{ \App\Purchase::$types[$item -> offer -> product -> getTypes()[0]]  }}" class="form-control form-control-sm disabled" disabled>
                        @endif
                    </div>

                    <div class="col-md-auto d-flex align-items-stretch">
                        <textarea name="message" id="message" rows="3" placeholder="Type text here to auto-encrypt to vendor or encrypt yourself." style="resize: 0" class="form-control form-control-sm">{{ $item -> message }}</textarea><br>
                    </div>
                    <div class="col-md-auto d-flex align-items-center justify-content-around py-2">
                        <a href="{{ route('profile.cart.remove', $productId) }}" class="btn btn-red">
                            <i class="fas fa-trash"></i>
                        </a>
                        @php
                        $preship = $item -> offer -> price * $item -> quantity;
                        $itemtotal = $preship + $item -> shipping -> price;
                        @endphp
                        @include('includes.currency', ['usdValue' => $itemtotal])
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i>
                        </button>
                    </div>
                </div>
                </div>

            </form>
        </div>
       @endforeach
      </div>
    @endforeach
        @else
            <div class="col-md-12 my-3">
                <div class="alert alert-warning">There are no items in cart!</div>
            </div>
        @endif

        <div class="col-md-12 py-2 justify-content-end">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="m-0">Total: @include('includes.currency', ['usdValue' => $totalSum])</h4>

                    <a href="{{ route('profile.cart.clear') }}" class="btn btn-red">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Clear
                    </a>
                    <a href="{{ route('profile.cart.make.purchases') }}" class="btn btn-primary">
                    <i class="fas fa-cart-arrow-down mr-2"></i>
                    Checkout
                    </a>
                </div>
            </div>

        </div>
    </div>

@stop
