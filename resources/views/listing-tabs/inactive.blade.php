
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->inactive as $ial)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($ial->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($ial), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($ial->rent) ?   number_format($ial->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $ial->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($ial->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($ial->baths, 'Bath') }}</li>
                </ul>
                {!! $ial->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$ial->realty_id}</p>" : '' !!}
                <p>Posted On: {{ $ial->created_at->format("m/d/y H:m A") }}</p>
                <div class="badges">
                    @if($ial->is_featured != REJECTFEATURED)
                        <span class="status" style="background: blueviolet;">{{($ial->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                    @endif
                    @if(!empty($ial->realty_id))
                        <span class="status" style="background: #213971;">Realty Feed</span>
                    @endif
                    <span class="status" style="background-color: red">Not Available</span>
                </div>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $ial->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $ial->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route('listing.detail', $ial->id) }}">
                        <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                    </a>
                    <a href="{{ route(whoAmI().'.repostListing', $ial->id) }}">
                        <button type="button" class="border-btn">Repost</button>
                    </a>
                    <a href="{{ route(whoAmI().'.listingStatus', $ial->id) }}" title="Unpublish this Listing">
                        <button type="button" class="border-btn">Archive</button>
                    </a>
                    @if($ial->is_featured != APPROVEFEATURED)
                        <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $ial->id) }}">
                            @if(isAdmin())
                                <button type="button" class="border-btn">Make Featured</button>
                            @elseif($ial->is_featured !== REQUESTFEATURED)
                                <button type="button" class="border-btn">Request Featured</button>
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->inactive->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->inactive->render() !!}
</div>


<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->inactive as $ial)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $ial->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ str_limit(is_exclusive($ial), STR_LIMIT_GRID_VIEW, ' ...') }}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ ($ial->rent) ?   number_format($ial->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $ial->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($ial->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($ial->baths, 'Bath') }}</li>
                        </ul>
                        {!! $ial->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$ial->realty_id}</p>" : '' !!}
                        <p>Posted On: {{ $ial->created_at->format("m/d/y H:m A") }}</p>
                        <div class="grid-badges">
                            @if($ial->is_featured != REJECTFEATURED)
                                <span class="status" style="background: blueviolet;">{{($ial->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                            @endif
                            @if(!empty($ial->realty_id))
                                <span class="status" style="background: #213971;">Realty Feed</span>
                            @endif
                                <span class="status" style="background-color: red;">Not Available</span>
                        </div>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.repostListing', $ial->id) }}">
                                <button type="button" class="border-btn">Repost</button>
                            </a>
                            <a href="{{ route(whoAmI().'.listingStatus', $ial->id) }}" title="Unpublish this Listing">
                                <button type="button" class="border-btn">Archive</button>
                            </a>
                            @if($ial->is_featured != APPROVEFEATURED)
                                <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $ial->id) }}">
                                    <button type="button" class="border-btn">{{ isAdmin() ? 'Make Featured' : 'Request for Featured' }}</button>
                                </a>
                            @endif
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $ial->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $ial->id) }}"><button><i class="fa fa-copy"></i></button></a>
                            <a href="{{ route('listing.detail', $ial->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->inactive->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $listing->inactive->render() !!}
</div>
