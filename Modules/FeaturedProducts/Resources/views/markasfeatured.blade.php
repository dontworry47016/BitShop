@if($product->featured == 0)
    <a href="{{ route('admin.product.markfeatured', $product) }}" class="btn btn-outline-primary">
        <i class="fas fa-star"></i>
    </a>
@else
    <a href="{{route('admin.featuredproducts.show')}}" class="btn btn-outline-primary active">
        <i class="fas fa-star"></i>
    </a>
@endif
