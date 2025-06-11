@extends('master.main')

@section('title', $category -> name . ' category')

@section('content')
    <div class="row">
        <div class="col-md-2 col-sm-12" style="margin-top:1.7em">
            @include('includes.categories')
        </div>
        <div class="col-md-10">
            <div class="row">
                <h1 class="col-md-11 text-center">{{ $category -> name}}
                </h1>
                <div class="col-md-1 text-lg-right">
                    @include('includes.viewpicker')
                </div>
            </div>
            <hr>

            @if($productsView == 'list')
                @foreach($products as $product)
                    @include('includes.product.row', ['product' => $product])
                @endforeach
            @else
                @foreach($products->chunk(6) as $chunks)
                    <div class="row mt-3">
                        @foreach($chunks as $product)
                            <div class="col-md-2 my-md-0 my-2 col-12 d-flex align-items-stretch">
                                @include('includes.product.card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif

            {{ $products -> links('includes.paginate') }}
        </div>

    </div>

@stop
