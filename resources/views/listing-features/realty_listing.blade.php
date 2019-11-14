

<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->realty as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($al->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($al), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
                <p>Freshness Score : 90%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                </ul>
                {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
                <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                <a href="{{ route(whoAmI().'.listingStatus', $al->id) }}" title="Publish this property"><span class="status">Archived</span></a>
            </div>
        </div>
    @endforeach
    @if($listing->realty->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->realty->render() !!}
</div>


<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->realty as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $al->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ str_limit(is_exclusive($al), STR_LIMIT_GRID_VIEW, ' ...') }}
                        </p>
                        <p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
                        <p>Freshness Score : 90%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                        </ul>
                        {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
                        <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                        <a href="{{ route(whoAmI().'.listingStatus', $al->id) }}" title="Publish this property">
                            <span class="status">Archived</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->realty->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $listing->realty->render() !!}
</div>
