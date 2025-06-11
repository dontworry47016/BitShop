<div class="row">
    @foreach($featuredProducts as $product)
        <div class="col-lg-2 mb-3 d-flex align-items-stretch">
            @include('includes.product.card', ['product' => $product])
        </div>
    @endforeach
</div>
