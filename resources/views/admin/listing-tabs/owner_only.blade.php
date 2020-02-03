
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->owner_only as $pl)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ Storage::url( $pl->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($pl), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                </ul>
                <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                @if(is_available($pl->availability))
                    <span class="status">Available</span>
                @else
                    <span class="status" style="background: red;">Not Available</span>
                @endif
                @if($pl->is_featured != REJECTFEATURED)
                    <span class="status" style="background: blueviolet;">{{($pl->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                @endif
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $pl->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $pl->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route('listing.detail', $pl->id) }}">
                        <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                    </a>
                    <a href="{{ route(whoAmI().'.repostListing', $pl->id) }}">
                        <button type="button" class="border-btn">Repost</button>
                    </a>
                    <a href="{{ route(whoAmI().'.archive', $pl->id) }}" title="Archive this Listing">
                        <button type="button" class="border-btn">Archive</button>
                    </a>
                    @if($pl->is_featured != APPROVEFEATURED)
                        <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $pl->id) }}">
                            <button type="button" class="border-btn">{{ isAdmin() ? 'Make Featured' : 'Request for Featured' }}</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->owner_only->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->owner_only->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->owner_only as $pl)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ Storage::url( $pl->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">{{ str_limit(is_exclusive($pl), STR_LIMIT_GRID_VIEW, ' ...') }}</p>
                        <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                        </ul>
                        <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                        @if(is_available($pl->availability))
                            <span class="status">Available</span>
                        @else
                            <span class="status" style="background: red;">Not Available</span>
                        @endif
                        @if($pl->is_featured != REJECTFEATURED)
                            <span class="status" style="background: blueviolet;">{{($pl->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                        @endif
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.repostListing', $pl->id) }}">
                                <button type="button" class="border-btn">Repost</button>
                            </a>
                            <a href="{{ route(whoAmI().'.archive', $pl->id) }}" title="Archive this Listing">
                                <button type="button" class="border-btn">Archive</button>
                            </a>
                            @if($pl->is_featured != APPROVEFEATURED)
                                <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $pl->id) }}">
                                    <button type="button" class="border-btn">{{ isAdmin() ? 'Make Featured' : 'Request for Featured' }}</button>
                                </a>
                            @endif
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $pl->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $pl->id) }}"><button><i class="fa fa-copy"></i></button></a>
                            <a href="{{ route('listing.detail', $pl->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->owner_only->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $listing->owner_only->render() !!}
</div>
