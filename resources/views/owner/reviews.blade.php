@extends('secured-layouts.app')
@section('title', 'Reviews')
@section('content')
    <div class="wrapper profile-contact-section">
        <div class="heading-wrapper">
            <h1>Reviews</h1>
            <a href="http://localhost:8000/agent/add-listing" class="btn-default" data-toggle="modal"
               data-target="#request-review">Request a Review</a>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab-1">
                            Reviews
                        </a>
                    </li>
                </ul>
            </div>
            <div class="block-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">
                        <div class="profile-contact-section profile-section-padding">
                            <div class="container-lg">
                                <div class="your-reviews-section">
                                    <div class="row">
                                        @if($reviews->isNotEmpty())
                                            @foreach($reviews as $review)
                                                <div class="col-sm-12 mrg-top">
                                                    <div class="review-box-wrapper">
                                                        <div class="review-inner-box-content">
                                                            <div class="agent-name">
                                                                <img src="{{ asset($review->from->profile_image ?? DUI) }}" alt="user-icon">
                                                                <h4> {{ $review->from->first_name.' '.$review->from->last_name }} </h4>
                                                            </div>
                                                            <div class="stars-icons">
                                                                @for($i = 0; $i < $review->rating; $i ++)
                                                                    <i class="fas fa-star"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <p> {{ $review->review_message }}</p>
                                                        <span> {{ dateReadable($review->created_at) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No Reviews Found</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    <div class="modal fade" id="request-review">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Request a Review</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                {!! Form::open(['url' => route('owner.requestReview'),'class' => 'ajax','reset' => 'true','id' => 'review-request']) !!}
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="form-group">
                               <label>Email</label>
                               {!! Form::select('email', renters(), null, ['class' => 'input-style','id' => 'renter_email']) !!}
                           </div>
                           <div class="form-group">
                               <label>Message</label>
                               {!! Form::textarea('message', null, ['class' => 'input-style', 'placeholder' => 'Message']) !!}
                           </div>
                       </div>
                   </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    {!! Form::submit('Send Request', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    {!! HTML::style('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css') !!}
    {!! HTML::script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js') !!}
    <script>
        let $disabledResults = $('select[name=email]');
        $disabledResults.select2();
    </script>
@endsection

