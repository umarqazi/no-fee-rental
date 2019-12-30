
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->pending as $pl)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset( $pl->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($pl), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                </ul>
                {!! isAdmin() ? "<p>Request By: {$pl->agent->first_name} {$pl->agent->last_name}</p>" : '' !!}
                <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                <span class="status" style="background: #ffce39;">Pending Request</span>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editListing', $pl->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $pl->id) }}">
                        <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    </a>
                    <a href="{{ route(whoAmI().'.approveRequest', $pl->id) }}" title="Publish this Listing">
                        <button type="button" class="border-btn">Approve</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->pending->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->pending->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->pending as $pl)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $pl->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">{{ str_limit(is_exclusive($pl), STR_LIMIT_GRID_VIEW, ' ...') }}</p>
                        <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                        </ul>
                        <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                        <span class="status" style="background: #ffce39;">Pending Request</span>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.approveRequest', $pl->id) }}" title="Publish this Listing">
                                <button type="button" class="border-btn">Approve</button>
                            </a>
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route(whoAmI().'.editListing', $pl->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route(whoAmI().'.copyListing', $pl->id) }}"><button><i class="fa fa-copy"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->pending->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
        {!! $listing->pending->render() !!}
</div>
