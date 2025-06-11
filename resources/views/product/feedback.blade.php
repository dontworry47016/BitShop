@extends('master.product')

@section('product-content')

    @if($product -> hasFeedback())
        <h3 class="mb-3">Product reviews: {{ count($product -> feedback) }}</h3>
        <table class="table table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:140px;">Quality</th>
                    <th style="width:140px;">Communication</th>
                    <th style="width:140px;">Shipping</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product -> feedback as $feedback)
                    <tr>
                        <td>
                            @include('includes.purchases.stars', ['stars' => $feedback -> quality_rate])
                        </td>
                        <td>
                            @include('includes.purchases.stars', ['stars' => $feedback -> communication_rate])
                        </td>
                        <td>
                            @include('includes.purchases.stars', ['stars' => $feedback -> shipping_rate])
                        </td>
                        <td>
                            {{ $feedback -> comment }}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else
        <div class="alert alert-warning text-center">There is no available feedback for this product, yet.</div>
    @endif

@stop
