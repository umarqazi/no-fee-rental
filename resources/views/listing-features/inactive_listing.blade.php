
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->inactive as $il)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset( $il->thumbnail ?? DLI ) }}" alt="" style="height:205px;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($il), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($fl->rent) ?   number_format($fl->rent,0) : 'None' }}</p>
                <p>Freshness Score : 90%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($il->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($il->baths, 'Bath') }}</li>
                </ul>
                {!! $il->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$il->realty_id}</p>" : '' !!}
                <p>Posted On: {{ $il->created_at->format("m/d/y H:m A") }}</p>
                <a href="{{ route(whoAmI().'.listingStatus', $il->id) }}" title="Publish this property">
                    <span class="status" style="background: red;">Inactive</span>
                </a>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $il->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $il->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.repostListing', $il->id) }}">
                        <button type="button" class="border-btn">Repost</button>
                    </a>
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
        @foreach($listing->inactive as $il)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $il->thumbnail ?? DLI ) }}" alt="" style="height:205px;" class="main-img" />
                    <div class="info">
                        <p class="title">{{ str_limit(is_exclusive($il), STR_LIMIT_GRID_VIEW, ' ...') }}</p>
                        <p><i class="fa fa-tag"></i> ${{ ($fl->rent) ?   number_format($fl->rent,0) : 'None' }}</p>
                        <p>Freshness Score : 90%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($il->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($il->baths, 'Bath') }}</li>
                        </ul>
                        {!! $il->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$il->realty_id}</p>" : '' !!}
                        <p>Posted On: {{ $il->created_at->format("m/d/y H:m A") }}</p>
                        <a href="{{ route(whoAmI().'.listingStatus', $il->id) }}" title="Publish this property"><span class="status" style="background: red;">Deactive</span></a>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.repostListing', $il->id) }}"><button type="button" class="border-btn">Repost</button></a>
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $il->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $il->id) }}"><button><i class="fa fa-copy"></i></button></a>
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
