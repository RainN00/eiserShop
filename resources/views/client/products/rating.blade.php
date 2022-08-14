@if (isset($rates) && $sumRating > 0)
<div class="row total_rate">
    <div class="col-6">
        <div class="box_total">
            <h5>Overall</h5>
            <h4>{{ number_format(($sumRating/count($rates)),1) }}</h4>
            <h6>({{ count($rates) }} Rating)</h6>
        </div>
    </div>
    <div class="col-6">
        <div class="rating_list">
            <h3>Based on {{ count($rates) }} Rating</h3>
            <ul class="list">
                @php
                $star1 = 0;
                $star2 = 0;
                $star3 = 0;
                $star4 = 0;
                $star5 = 0;
                @endphp
                @foreach ($rates as $rate)
                @php
                if ($rate->rating == 1) {
                $star1 ++;
                }
                if ($rate->rating == 2) {
                $star2 ++;
                }
                if ($rate->rating == 3) {
                $star3 ++;
                }
                if ($rate->rating == 4) {
                $star4 ++;
                }
                if ($rate->rating == 5) {
                $star5 ++;
                }
                @endphp
                @endforeach
                <li>
                    5 Star
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> {{ $star5 }}
                </li>
                <li>
                    4 Star
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i> {{ $star4 }}
                </li>
                <li>
                    3 Star
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i> {{ $star3 }}
                </li>
                <li>
                    2 Star
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i> {{ $star2 }}
                </li>
                <li>
                    1 Star
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i> {{ $star1 }}
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="review_list">
    @foreach ($rates as $rate)
    <div class="review_item">
        <div class="media">
            {{-- --}}
            <div class="media-body">
                <h4>{{ $rate->fullname }}</h4>
                <h4>{{ $rate->email }}</h4>
                @if ($rate->rating == 1 )
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                @endif
                @if ($rate->rating == 2 )
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                @endif
                @if ($rate->rating == 3 )
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                @endif
                @if ($rate->rating == 4 )
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                @endif
                @if ($rate->rating == 5 )
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                @endif

            </div>
        </div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
            ullamco laboris nisi ut aliquip ex ea commodo
        </p>
    </div>
    @endforeach
</div>
@endif
