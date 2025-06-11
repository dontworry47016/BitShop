@extends('master.main')

@section('title','Product - ' . $product -> name )

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="slider">
                <div class="slides">
                    @php $i = 1; @endphp
                    @foreach($product -> images() -> orderBy('first', 'desc') -> get() as $image)
                        <div id="slide-{{ $i++ }}">
                            <img src="{{ asset('storage/' . $image -> image) }}">
                        </div>
                    @endforeach
                </div>

                @php $i = 1; @endphp
                @foreach($product -> images as $image)
                    <a href="#slide-{{ $i }}">{{ $i++ }}</a>
                @endforeach
            </div>
        </div>

        <div class="col-md-5 text-center">
            @include('includes.flash.error')

            <h2>{{ $product -> name }}</h2>
            <hr>

            <div class="row">
                <div class="col-md-12 text-center">

                    <form action="{{ route('profile.cart.add', $product) }}"  method="POST">
                        {{ csrf_field() }}

                    <table class="table border-0 text-left table-borderless">
                        <tbody>

                        <tr>
                            <td class="text-right">Quality:</td>
                            <td>
                                @include('includes.purchases.stars', ['stars' => (int)$product->avgRate('quality_rate')])
                            </td>
                        </tr>
                        @if(!$product -> isUnlimited())
                        <tr>
                            <td class="text-right">
                                Price:
                            </td>
                            <td>
                                    @foreach($product -> offers as $offer)
                                        <li>
                                            <strong>@include('includes.currency',['usdValue' => $offer -> dollars])</strong> per {{ str_plural($product -> mesure, 1) }},
                                            for {{ $offer -> min_quantity }}+
                                        </li>
                                    @endforeach
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-right">
                                Price
                            </td>
                            <td>
                                @foreach($product -> offers as $offer)
                                    <strong>@include('includes.currency', ['usdValue' => $offer -> dollars])</strong>
                                @endforeach
                            </td>
                        </tr>
                        @endif
                        <tr>
                            @if(!$product -> isUnlimited())
                            <td class="text-right">Left/Sold:</td>
                            <td>
                                <span class="badge badge-primary">{{ $product -> quantity }} {{ str_plural($product -> mesure, $product -> quantity) }}</span> / 
                                <span class="badge badge-primary">{{ $product -> orders }} {{ str_plural($product -> mesure, $product -> orders) }} </span>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if($product->user->vendor->experience < 0)
                                    <p class="text-danger border border-danger rounded p-1 mt-2"><span
                                                class="fas fa-exclamation-circle"></span> Negative experience, trade with caution!
                                    </p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if($product -> isPhysical())
                                <td class="text-right">
                                    <label for="delivery">Delivery:</label>
                                </td>
                                <td>
                                    <select name="delivery" id="delivery"
                                            class="form-control form-control-sm @if($errors -> has('delivery')) is-invalid @endif">
                                        @foreach($product -> specificProduct() -> shippings as $shipping)
                                            <option value="{{ $shipping -> id }}">{{ $shipping -> long_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endif
                        </tr>

                        <tr>
                            <td class="text-right">
                                <label for="coin">Coin:</label>
                            </td>
                            <td>
                                 <select name="coin" id="coin" class="form-control form-control-sm">
                                     @foreach($product -> getCoins() as $coin)
                                         <option value="{{ $coin }}">{{ strtoupper(\App\Purchase::coinDisplayName($coin)) }}</option>
                                     @endforeach
                                 </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <label for="type">Type(s):</label>
                            </td>
                            <td>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        @foreach($product -> getTypes() as $type)
                                            <option value="{{ $type }}">{{ \App\Purchase::$types[$type] }}</option>
                                        @endforeach
                                    </select>
                            </td>
                        </tr>
                        <tr>

                            <td class="text-right">
                            @if(!$product -> isUnlimited())
                                <label for="amount">Amount:</label>
                            @endif
                            </td>
                            <td class="row">
                                @if($product -> isUnlimited())
                                <input style="display: none;" type="number" min="1" name="amount" id="amount"
                                        value="1"
                                        max="{{ $product -> quantity }}"
                                        class="@if($errors -> has('amount')) is-invalid @endif form-control form-control-sm"
                                        placeholder="Amount of {{ str_plural($product -> mesure) }}"/>
                                @else
                                <div class="col-mx-auto">
                                    <input type="number" min="1" name="amount" id="amount"
                                           value="1"
                                           max="{{ $product -> quantity }}"
                                           class="@if($errors -> has('amount')) is-invalid @endif form-control form-control-sm"
                                           placeholder="Amount of {{ str_plural($product -> mesure) }}"/>
                                @endif
                                <div class="row py-2">
                                <div class="col-mx-auto">
                                    @auth
                                        @if(auth() -> user() -> isWhishing($product))
                                            <a href="{{ route('profile.wishlist.add', $product) }}"
                                               class="btn btn-sm btn-block mb-2 btn-primary"><i class="far fa-heart"></i>Remove from wishlist</a>
                                        @else
                                            <a href="{{ route('profile.wishlist.add', $product) }}"
                                               class="btn btn-sm btn-block mb-2 btn-primary"><i
                                                        class="fas fa-heart"></i>Add to wishlist</a>
                                        @endif
                                    @endauth
                                    <button class="btn btn-sm btn-block mb-2 btn-primary"><i class="fas fa-plus mr-2"></i>Add to cart</button>
                                </div>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    </form>
                        @include('includes.flash.invalid')

                </div>


            </div>
        </div>

        {{-- Shop with Confidence --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Seller information
                </div>

                <div class="card-body text-center">
                    <div class="card-body text-center">
                    <img class="image rounded-circle" src="{{asset('/storage/images/'.$product->user->image)}}" alt="" style="width: 80px; height: 80px; padding: 0px; margin: 0px;">
                    </div>
                    <div class="btn-group" style="padding: 10px; margin: 0px;">
                        <a class="btn btn-primary btn-sm" href="{{ route('vendor.show', $product -> user) }}">
                            <span >{{ $product -> user -> username }}</span></a>

                        <span class="btn btn-primary active btn-sm">Level {{$product->user->vendor->getLevel()}}</span>
                    </div>

                    @php
                    $vendor = $product->user;
                    @endphp
                    <div class="row my-1 text-md-center">
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
                    <hr>
                        <a href="{{route('search',['user'=>$product->user->username])}}"  class="btn mb-1 btn-primary"><span class="fas fa-store"></span> All products: {{$product -> user ->products()->count()}}</a>
                        <a href="{{ route('profile.messages').'?otherParty='.$product -> user ->username}}" class="btn mb-1 btn-primary"><span class="fas fa-envelope"></span> Send message</a>

                </div>
            </div>
        </div>

    </div>

    {{-- Product menu --}}
    <ul id="productsmenu" class="my-4 nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link @isroute('product.show') active @endisroute"
               href="{{ route('product.show', $product) }}#productsmenu">Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @isroute('product.feedback') active @endisroute"
               href="{{ route('product.feedback', $product) }}#productsmenu">Feedback</a>
        </li>
        @if($product -> isPhysical())
            <li class="nav-item">
                <a class="nav-link @isroute('product.delivery') active @endisroute"
                   href="{{ route('product.delivery', $product) }}#productsmenu">Delivery</a>
            </li>
        @endif


    </ul>

    @yield('product-content')
@stop
