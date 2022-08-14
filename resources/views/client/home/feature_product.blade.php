<!--================ Feature Product Area =================-->
<section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row">
            @foreach ($feature_products as $feature_product)
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100"
                            src="{{ asset($feature_product->thumbnail) }}" alt="" />
                        <div class="p_icon">
                            <a href="{{ route('client.product.index', ['id'=>$feature_product->id]) }}">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="#">
                                <i class="ti-heart"></i>
                            </a>
                            <a class="btn-add-to-cart" href="{{ route('client.ajax.addToCart') }}" data-product="{{ $feature_product->id }}">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{ route('client.product.index', ['id'=>$feature_product->id]) }}" class="d-block">
                            <h4>{{ $feature_product->name }}</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">{{ number_format($feature_product->price,2) }} $</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================ End Feature Product Area =================-->
