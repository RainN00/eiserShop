<!--================ Inspired Product Area =================-->
<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Best seller products</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($bestseller_products as $bestseller_product)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100"
                                src="{{ asset($bestseller_product->thumbnail) }}" alt="" />
                            <div class="p_icon">
                                <a href="{{ route('client.product.index', ['id'=>$bestseller_product->id]) }}">
                                    <i class="ti-eye"></i>
                                </a>
                                <a href="#">
                                    <i class="ti-heart"></i>
                                </a>
                                <a class="btn-add-to-cart" href="{{ route('client.ajax.addToCart') }}" data-product="{{ $bestseller_product->id }}">
                                    <i class="ti-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="{{ route('client.product.index', ['id'=>$bestseller_product->id]) }}" class="d-block">
                                <h4>{{ $bestseller_product->name }}</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">{{ number_format($bestseller_product->price,2) }} $</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--================ End Inspired Product Area =================-->
