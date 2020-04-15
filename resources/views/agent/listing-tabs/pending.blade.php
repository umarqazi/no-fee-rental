
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->pending as $pl)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ Storage::url( $pl->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{!! str_limit(is_exclusive($pl), STR_LIMIT_LIST_VIEW, ' ...') !!}</p>
                <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                </ul>
                <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                <span class="status" style="background: #ffce39;">Request Pending For Approval</span>
            </div>
        </div>
    @endforeach
    @if($listing->pending->total() < 1)
        <p class="null">No Pending Lists Found</p>
    @endif
    {!! $listing->pending->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->pending as $pl)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ Storage::url( $pl->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">{!! str_limit(is_exclusive($pl), STR_LIMIT_LIST_VIEW, ' ...') !!}</p>
                        <p><i class="fa fa-tag"></i> ${{ ($pl->rent) ?   number_format($pl->rent,0) : 'None' }}</p>
                        <p>Freshness Score : {{ $pl->freshness_score }}%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ str_formatting($pl->bedrooms, 'Bed') }}</li>
                            <li><i class="fa fa-bath"></i> {{ str_formatting($pl->baths, 'Bath') }}</li>
                        </ul>
                        <p>Posted On: {{ $pl->created_at->format("m/d/y H:m A") }}</p>
                        <span class="status" style="background: #ffce39;">Request Pending For Approval</span>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->pending->total() < 1)
            <p class="null">No Pending Lists Found</p>
        @endif
    </div>
        {!! $listing->pending->render() !!}
</div>
