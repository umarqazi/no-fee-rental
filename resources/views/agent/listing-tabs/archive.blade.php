
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->archived as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ Storage::url($al->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
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
                    @if(!empty($al->realty_id))
                        <span class="status" style="background: #213971;">Realty Feed</span>
                    @endif
                </div>
                <div class="actions-btns">
                    @if(isAgentHasPlan() || isMRGAgent())
                        <a href="{{ route(whoAmI().'.unArchive', $al->id) }}" title="UnArchive this Listing">
                            <button type="button" class="border-btn">UnArchive</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->archived->total() < 1)
        <p class="null">No Archive Lists Found</p>
    @endif
    {!! $listing->archived->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->archived as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ Storage::url( $al->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
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
                            @if(!empty($al->realty_id))
                                <span class="status" style="background: #213971;">Realty Feed</span>
                            @endif
                        </div>
                        <div class="actions-btns">
                            @if(isAgentHasPlan() || isMRGAgent())
                                <a href="{{ route(whoAmI().'.unArchive', $al->id) }}" title="UnArchive this Listing">
                                    <button type="button" class="border-btn">UnArchive</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->archived->total() < 1)
            <p class="null">No Archive Lists Found</p>
        @endif
    </div>
    {!! $listing->archived->render() !!}
</div>
