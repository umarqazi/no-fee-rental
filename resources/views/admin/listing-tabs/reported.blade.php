
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->reported as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($al->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($al), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $al->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                </ul>
                <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                <div class="badges">
                    @if($al->is_featured != REJECTFEATURED)
                        <span class="status" style="background: blueviolet;">{{($al->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                    @endif

                    @if(!empty($al->realty_id))
                        <span class="status" style="background: #213971;">Realty Feed</span>
                    @endif

                    @if(is_available($al->availability))
                        <span class="status">Available</span>
                    @else
                        <span class="status" style="background: red;">Not Available</span>
                    @endif
                    <p class="see-reports" data-toggle="modal" data-target="#seeReports">See Reports</p>
                </div>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $al->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $al->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route('listing.detail', $al->id) }}">
                        <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                    </a>
                    <a href="{{ route(whoAmI().'.archive', $al->id) }}" title="Archive this Listing">
                        <button type="button" class="border-btn">Archive</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->reported->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->reported->render() !!}
</div>


<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->reported as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $al->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ str_limit(is_exclusive($al), STR_LIMIT_GRID_VIEW, ' ...') }}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $al->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                        </ul>
                        <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                        <div class="grid-badges">
                            @if($al->is_featured != REJECTFEATURED)
                                <span class="status" style="background: blueviolet;">{{($al->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                            @endif

                            <span class="status" style="background: #213971;">Realty Feed</span>

                            @if(is_available($al->availability))
                                <span class="status">Available</span>
                            @else
                                <span class="status" style="background: red;">Not Available</span>
                            @endif

                        </div>
                        <div class="actions-btns action-btn-reports">
                            <a href="{{ route(whoAmI().'.archive', $al->id) }}" title="Archive this Listing">
                                <button type="button" class="border-btn">Archive</button>
                            </a>
                            <p class="see-reports" data-toggle="modal" data-target="#seeReports">See
                                Reports</p>
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $al->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $al->id) }}"><button><i class="fa fa-copy"></i></button></a>
                            <a href="{{ route('listing.detail', $al->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->reported->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $listing->reported->render() !!}
</div>

<div class="modal fade" id="seeReports">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Report this listing <br>
                    <p>6650 Hillside Road, New York, Upper West Side</p>
                </h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="profilecard-detaill">
                    <h3>Report Reason</h3>

                    <div class="form-group">
                        <p><strong>User Name: </strong><span>Muhammad Yousuf</span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Email: </strong><span></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>phone Number: </strong><span></span></p>
                    </div>
                    <div class="form-group">
                        <p><strong>Reason: </strong><span></span></p>
                    </div>
                    <div class="form-group text-message">
                        <p><strong>Message: </strong> <span>jkhfjkhsdfjkhdf nbkhjkhasdfjk jbhjkhjkash kbjkhdjkhsfjk
                            jbhjkashjkfhsj bjkhasdjkhjk bjksdfhjkdh jkbjkhjhjk jhjkhfjdhj jkhsjkadhjkfshjk
                                jkshjksdfhjk jksdjkhdfjkh jkhejkhrjkk fnbjkhajkdshjkfh</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

