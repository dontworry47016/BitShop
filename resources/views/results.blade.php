@extends('master.main')

@section('title','Home Page')

@section('content')

    <div class="row">
        <div class="col-md-2">
            @include('includes.detailedsearch')
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-6">
                    <h4 class="float-left">Search results for "{{$query}}" @if(request('user')) by user {{request('user')}} @endif</h4>
                </div>
                <div class="col-md-1">
                    @include('includes.viewpicker')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
            @if($products->count() == 0)
                <h4>
                    Couln't find any results for that query, try searching for something else
                </h4>
            @else
                @if($productsView == 'list')
                    @foreach($products as $product)
                        @include('includes.product.row', ['product' => $product])
                    @endforeach
                @else
                    @foreach($products->chunk(6) as $chunks)
                        <div class="row mt-3">
                            @foreach($chunks as $product)
                                <div class="col-lg-2 mb-3 d-flex align-items-stretch">
                                    @include('includes.product.card', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif

            @endif

            <div class="mt-4">
                {{ $products -> links('includes.paginate') }}
            </div>
               <div class="col-5">
                    <p class="text-secondary small mt-2 ">
                        Fetched {{$results_count}} {{str_plural('result',$products->count())}}
                        in {{$time}} {{str_plural('second',$time)}}</p>
                </div>
        </div>

    </div>

@stop
