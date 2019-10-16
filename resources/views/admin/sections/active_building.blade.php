
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->active as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($al->apartments[0]->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($al->apartments[0]), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p class="title">Total Agents: {{ count($al->apartments) }}</p>
                <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                <a href="{{ route(whoAmI().'.listingStatus', $al->apartments[0]->id) }}" title="Unpublish this property"><span class="status">Active</span></a>
                @if($al->apartments[0]->is_featured != REJECTFEATURED)
                    <span class="status" style="margin-right: 60px;background: blueviolet;">{{($al->apartments[0]->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                @endif
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $al->apartments[0]->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $al->apartments[0]->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route('listing.detail', $al->apartments[0]->id) }}">
                        <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                    </a>
                    <a href="{{ route(whoAmI().'.repostListing', $al->apartments[0]->id) }}">
                        <button type="button" class="border-btn">Repost</button>
                    </a>
                    @if($al->apartments[0]->is_featured != APPROVEFEATURED)
                        <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $al->apartments[0]->id) }}">
                            <button type="button" class="border-btn">{{ isAdmin() ? 'Make Featured' : 'Request for Featured' }}</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->active->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->active->render() !!}
</div>


<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->active as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $al->apartments[0]->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ str_limit(is_exclusive($al), STR_LIMIT_GRID_VIEW, ' ...') }}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ $al->apartments[0]->rent }}</p>
                        <p>Freshness Score : 90%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($al->apartments[0]->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($al->apartments[0]->baths, 'Bath') }}</li>
                        </ul>
                        {!! $al->apartments[0]->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->apartments[0]->realty_id}</p>" : '' !!}
                        <p>Posted On: {{ $al->apartments[0]->created_at->format("m/d/y H:m A") }}</p>
                        <a href="{{ route(whoAmI().'.listingStatus', $al->apartments[0]->id) }}" title="Unpublish this property">
                            <span class="status">Active</span>
                        </a>
                        @if($al->apartments[0]->is_featured != REJECTFEATURED)
                            <span class="status" style="margin-right: 60px;background: blueviolet;">{{($al->apartments[0]->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                        @endif
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.repostListing', $al->apartments[0]->id) }}">
                                <button type="button" class="border-btn">Repost</button>
                            </a>
                            @if($al->apartments[0]->is_featured != APPROVEFEATURED)
                                <a href="{{ route(whoAmI().(isAdmin() ? '.approveFeature' : '.requestFeatured'), $al->apartments[0]->id) }}">
                                    <button type="button" class="border-btn">{{ isAdmin() ? 'Make Featured' : 'Request for Featured' }}</button>
                                </a>
                            @endif
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $al->apartments[0]->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $al->apartments[0]->id) }}"><button><i class="fa fa-copy"></i></button></a>
                            <a href="{{ route('listing.detail', $al->apartments[0]->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->active->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->active->render() !!}
</div>
