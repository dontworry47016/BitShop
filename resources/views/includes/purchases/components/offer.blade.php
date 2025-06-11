<div class="col-md-12">
    <h3 class="mb-2">Details</h3>
    <table class="table">
        @if($purchase -> shipping)
            <tr>
                <td>Shipping type:</td>
                <td>{{ $purchase -> shipping -> name }}</td>
            </tr>
            <tr>
                <td>Delivery time:</td>
                <td>{{ $purchase -> shipping -> duration }}</td>
            </tr>
            <tr>
                <td>Shipping price:</td>
                <td><strong>@include('includes.currency', ['usdValue' => $purchase -> shipping -> price])</strong></td>
            </tr>
        @else
            {{-- If the buyer deposited enough sum --}}
            @if($purchase -> isBuyer() && $purchase -> enoughBalance())
                <p>Automatic delivery:</p>
                <textarea class="form-control disabled" readonly rows="10">{{ $purchase -> delivered_product }}</textarea>
            @elseif($purchase -> isBuyer())
                <div class="alert alert-warning">
                    After payment is detected on address the market will deliver the content here.
                </div>
            @endif
        @endif
        <tr>
            <td>Type:</td>
            <td>{{ \App\Purchase::$types[$purchase->type] }}</td>
        </tr>
        <tr>
            <td>Purchased amount:</td>
            <td>
                <span class="badge badge-primary">{{ $purchase -> quantity }} {{ str_plural($purchase -> offer -> product -> mesure, $purchase -> quantity) }}</span>
            </td>
        </tr>
        <tr>
            <td>Price:</td>
            <td><strong>@include('includes.currency', ['usdValue' => $purchase -> offer -> price])</strong>
                per {{ $purchase -> offer -> product -> mesure }}</td>
        </tr>
        <tr>
            <td>Total:</td>
            <td><strong>@include('includes.currency', ['usdValue' => $purchase -> value_sum])</strong></td>
        </tr>
    </table>
</div>
