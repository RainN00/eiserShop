<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>{{ $productDetail->content }}</p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5>128mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5>508mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Depth</h5>
                                </td>
                                <td>
                                    <h5>85mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Weight</h5>
                                </td>
                                <td>
                                    <h5>52gm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5>yes</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Freshness Duration</h5>
                                </td>
                                <td>
                                    <h5>03days</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>When packeting</h5>
                                </td>
                                <td>
                                    <h5>Without touch of hand</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Each Box contains</h5>
                                </td>
                                <td>
                                    <h5>60pcs</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            @foreach ($productDetail->comments as $comment)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset($comment->user->avatar) }}" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ $comment->user->firstname }} {{ $comment->user->lastname }}</h4>
                                            <h5>{{ Carbon\Carbon::createFromTimestamp($comment->created_at)->toDateTimeString() }}</h5>
                                        </div>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            @if (Auth::check())
                                <form class="row contact_form" action="contact_process.php" method="post" id="contactForm"
                                novalidate="novalidate">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="2"
                                                placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" data-productID="{{ $productDetail->id }}" value="submit" class="btn submit_btn btn-comment">
                                            Submit Now
                                        </button>
                                    </div>
                                </form>
                            @else
                                <a href="{{ route('client.users.login') }}">Please login to comment !!!</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6 rate_list">
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
                                    {{--  --}}
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
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                </fieldset>
                            </ul>
                            <p>Outstanding</p>
                            <form class="row contact_form" id="contactForm" vnovalidate="novalidate">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="namerate" name="namerate"
                                        value="@if (Auth::check()){{ Auth::user()->firstname }} {{Auth::user()->lastname}} @endif"   placeholder="Your Full name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="messagerate" id="messagerate" rows="2"
                                            placeholder="Review"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" data-productIdRate="{{ $productDetail->id }}" class="btn submit_btn btn-rating">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->
