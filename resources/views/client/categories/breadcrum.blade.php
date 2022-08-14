<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Shop category</h2>
                </div>
                <div class="page_link">
                    <a href="{{ route('client.home') }}">Home</a>
                    @if (isset($categoryBreadCrum->name))
                        <a href="{{ route('client.categories.index') }}">Categories</a>
                        <span>{{ $categoryBreadCrum->name }}</span>
                    @else
                        <span>Categories</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
