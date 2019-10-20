
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->non_verified as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($al->listings[0]->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($al->listings[0]), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p class="title">Total Agents: {{ count($al->listings) }}</p>
                <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                <a href="{{ route(whoAmI().'.verifyBuilding', $al->id) }}" title="Verify this building">
                    <span class="status" style="background-color:red;">Verify</span>
                </a>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $al->listings[0]->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $al->listings[0]->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route('listing.detail', $al->listings[0]->id) }}">
                        <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                    </a>
                    <a href="{{ route(whoAmI().'.repostListing', $al->listings[0]->id) }}">
                        <button type="button" class="border-btn">Repost</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->non_verified->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->non_verified->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->non_verified as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $al->listings[0]->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ str_limit(is_exclusive($al), STR_LIMIT_GRID_VIEW, ' ...') }}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ $al->listings[0]->rent }}</p>
                        <p>Freshness Score : 90%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($al->listings[0]->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($al->listings[0]->baths, 'Bath') }}</li>
                        </ul>
                        {!! $al->listings[0]->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->listings[0]->realty_id}</p>" : '' !!}
                        <p>Posted On: {{ $al->listings[0]->created_at->format("m/d/y H:m A") }}</p>
                        <a href="{{ route(whoAmI().'.listingStatus', $al->listings[0]->id) }}" title="UnPublish this property">
                            <span class="status">Active</span>
                        </a>
                        @if($al->listings[0]->is_featured != REJECTFEATURED)
                            <span class="status" style="margin-right: 60px;background: blueviolet;">{{($al->listings[0]->is_featured == REQUESTFEATURED) ? 'Requested for feature' : 'Featured' }}</span>
                        @endif
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.repostListing', $al->listings[0]->id) }}">
                                <button type="button" class="border-btn">Repost</button>
                            </a>
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $al->listings[0]->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $al->listings[0]->id) }}"><button><i class="fa fa-copy"></i></button></a>
                            <a href="{{ route('listing.detail', $al->listings[0]->id) }}"><button><i class="fa fa-eye"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->non_verified->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->non_verified->render() !!}
</div>
