@extends('master.main')

@section('title','Home Page')

@section('content')

    <div class="row">
        <div class="col-md-2 col-sm-12" style="margin-top:2.2em">
            @include('includes.categories')
        </div>
        <div class="col-md-10 col-sm-12 mt-3 ">

            <div class="row">
                <div class="col">
                    <h1 class="col-10 text-center"><i class="fas fa-award"></i> Featured products</h1>
                    <hr>
                </div>
            </div>

            @isModuleEnabled('FeaturedProducts')
                @include('featuredproducts::frontpagedisplay')
            @endisModuleEnabled

            <div class="row mt-4">

                <div class="col-md-4 text-center">
                    <h4>
                        Top Vendors
                    </h4>
                    <hr>
                    @foreach(\App\Vendor::topVendors() as $vendor)
                        <table class="table table-borderless table-hover align-content-center justify-content-center">
                            <tr>
                                <td>
                                    <a href="{{route('vendor.show',$vendor)}}"
                                       style="text-decoration: none; color:#ffffff">{{$vendor->user->username}}</a>
                                </td>
                                <td class="text-end">
                                    <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-danger @endif active"
                                          style="cursor:default">Level {{$vendor->getLevel()}}</span>

                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>
                <div class="col-md-4 text-center">
                    <h4>
                        Latest orders
                    </h4>
                    <hr>
                    @foreach(\App\Purchase::latestOrders() as $order)
                        <table class="table table-borderless table-hover align-content-center">
                            <tr>
                                <td>
                                    <img class="img-fluid" height="23px" width="23px"
                                         src="{{ asset('storage/'  . $order->offer->product->frontImage()->image) }}"
                                         alt="{{ $order->offer->product->name }}">
                                </td>
                                <td>
                                    {{str_limit($order->offer->product->name,50,'...')}}
                                </td>
                                <td class="text-end">
                                    {{$order->getLocalSymbol()}}{{$order->getSumLocalCurrency()}}
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>

                <div class="col-md-4 text-center">
                    <h4>
                        Rising vendors
                    </h4>
                    <hr>
                    @foreach(\App\Vendor::risingVendors() as $vendor)
                        <table class="table table-borderless table-hover">
                            <tr>
                                <td>
                                    <a href="{{route('vendor.show',$vendor)}}"
                                       style="text-decoration: none; color:#ffffff">{{$vendor->user->username}}</a>
                                </td>
                                <td class="text-end">
                                    <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-danger @endif active"
                                          style="cursor:default">Level {{$vendor->getLevel()}}</span>
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>


            </div>


        </div>

    </div>

@stop
