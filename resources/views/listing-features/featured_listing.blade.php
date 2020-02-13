
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->featured as $fl)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ is_realty_listing($fl->thumbnail) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($fl), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ ($fl->rent) ?   number_format($fl->rent,0) : 'None' }}</p>
                <p>Freshness Score : {{ $fl->freshness_score }}%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($fl->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($fl->baths, 'Bath') }}</li>
                </ul>
                {!! $fl->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$fl->realty_id}</p>" : '' !!}
                <p>Requested By: {{ $fl->agent->first_name.' '.$fl->agent->last_name }}</p>
                <p>Posted On: {{ $fl->created_at->format("m/d/y H:m A") }}</p>
                    <span class="status" style="background: red;">Remove Feature</span>
                <div class="actions-btns">
                    <a href="{{ route('admin.editListing', $fl->id) }}">
                        <span>
                            <img src="{{Storage::url('assets/images/edit-icon.png')}}" alt="">
                        </span>
                    </a>
                    <a href="{{ route(whoAmI().'.copyListing', $fl->id) }}">
                        <span>
                            <img src="{{Storage::url('assets/images/copy-icon.png')}}" alt="">
                        </span>
                    </a>
                    <a href="{{ route('admin.repostListing', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
                    <a href="{{ route('admin.removeFeatured', $fl->id) }}" title="Remove this property from featured">
                        <button type="button" class="border-btn">Remove Feature</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->featured->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $listing->featured->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->featured as $fl)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="listing-thumb">
                <img src="{{ is_realty_listing($fl->thumbnail) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                <div class="info">
                    <p class="title">{{ str_limit(is_exclusive($fl), STR_LIMIT_GRID_VIEW, ' ...') }}</p>
                    <p><i class="fa fa-tag"></i> ${{ ($fl->rent) ?   number_format($fl->rent,0) : 'None' }}</p>
                    <p>Freshness Score : {{ $fl->freshness_score }}%</p>
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ str_formatting($fl->bedrooms, 'Bed') }}</li>
                        <li><i class="fa fa-bath"></i> {{ str_formatting($fl->baths, 'Bath') }}</li>
                    </ul>
                    {!! $fl->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$fl->realty_id}</p>" : '' !!}
                    <p>Requested By: {{ $fl->agent->first_name.' '.$fl->agent->last_name }}</p>
                    <p>Posted On: {{ $fl->created_at->format("m/d/y H:m A") }}</p>
                    <div class="actions-btns">
                        <a href="{{ route('admin.repostListing', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
                        <a href="{{ route('admin.removeFeatured', $fl->id) }}" title="Remove this property from featured">
                            <button type="button" class="border-btn">Remove Feature</button>
                        </a>
                    </div>
                    <div class="list-actions-icons">
                        <a href="{{ route('admin.editListing', $fl->id) }}"><button><i class="fa fa-edit"></i></button></a>
                        <a href="{{ route('admin.copyListing', $fl->id) }}"><button><i class="fa fa-copy"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @if($listing->featured->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
        {!! $listing->featured->render() !!}
</div>
