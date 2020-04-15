
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->realty as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ is_realty_listing($al->thumbnail) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{!! str_limit(is_exclusive($al), STR_LIMIT_LIST_VIEW, ' ...') !!}</p>
                <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $al->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                </ul>
                {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
                <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                <div class="badges">
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
                    @if($listing->has_repost || isMRGAgent())
                        <a href="{{ route(whoAmI().'.repostListing', $al->id) }}">
                            <button type="button" class="border-btn">Repost</button>
                        </a>
                    @endif
                    <a href="{{ route(whoAmI().'.archive', $al->id) }}" title="Archive this Listing">
                        <button type="button" class="border-btn">Archive</button>
                    </a>
                    @if($al->is_featured != APPROVEFEATURED)
                        @if($listing->has_featured || isMRGAgent())
                            <a href="{{ route('agent.makeFeature', $al->id )}}" title="Make this property featured">
                                <button type="button" class="border-btn">Make Featured</button>
                            </a>
                        @elseif($al->is_featured != REQUESTFEATURED)
                            <a href="{{ route(whoAmI().'.requestFeatured', $al->id) }}">
                                <button type="button" class="border-btn">Request for Featured</button>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->realty->total() < 1)
        <p class="null">No Realty Lists Found</p>
    @endif
    {!! $listing->realty->render() !!}
</div>
<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->realty as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ is_realty_listing($al->thumbnail) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {!! str_limit(is_exclusive($al), STR_LIMIT_LIST_VIEW, ' ...') !!}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $al->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                        </ul>
                        {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
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
                        <div class="actions-btns">
                            @if($listing->has_repost || isMRGAgent())
                                <a href="{{ route(whoAmI().'.repostListing', $al->id) }}">
                                    <button type="button" class="border-btn">Repost</button>
                                </a>
                            @endif
                            <a href="{{ route(whoAmI().'.archive', $al->id) }}" title="Archive this Listing">
                                <button type="button" class="border-btn">Archive</button>
                            </a>
                            @if($al->is_featured != APPROVEFEATURED)
                                @if($listing->has_featured || isMRGAgent())
                                    <a href="{{ route('agent.makeFeature', $al->id )}}" title="Make this property featured">
                                        <button type="button" class="border-btn">Make Featured</button>
                                    </a>
                                @elseif($al->is_featured != REQUESTFEATURED)
                                    <a href="{{ route(whoAmI().'.requestFeatured', $al->id) }}">
                                        <button type="button" class="border-btn">Request for Featured</button>
                                    </a>
                                @endif
                            @endif
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
        @if($listing->realty->total() < 1)
            <p class="null">No Realty Lists Found</p>
        @endif
    </div>
    {!! $listing->realty->render() !!}
</div>
