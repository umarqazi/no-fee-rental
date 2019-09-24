
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->featured as $fl)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset(!empty($fl->thumbnail) ? $fl->thumbnail : DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ str_limit(is_exclusive($fl->listingTypes) ? $fl->street_address : $fl->display_address, STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                <p><i class="fa fa-tag"></i> ${{ $fl->rent }}</p>
                <p>Freshness Score : 90%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ str_formatting($fl->bedrooms, 'Bed') }}</li>
                    <li><i class="fa fa-bath"></i> {{ str_formatting($fl->baths, 'Bath') }}</li>
                </ul>
                {!! $fl->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$fl->realty_id}</p>" : '' !!}
                <p>Requested By: {{ $fl->agent->first_name.' '.$fl->agent->last_name }}</p>
                <p>Posted On: {{ $fl->created_at->format("m/d/y H:m A") }}</p>
                <a href="{{ route('admin.removeFeatured', $fl->id) }}" title="Remove this property from featured">
                    <span class="status" style="background: red;">Remove Feature</span>
                </a>
                <div class="actions-btns">
                    <a href="{{ route('admin.editListing', $fl->id) }}"><span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span></a>
                    <span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span>
                    <a href="{{ route('admin.repostListing', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
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
                <img src="{{isset($fl->thumbnail) ? asset('storage/'.$fl->thumbnail) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="width: 400px;" class="main-img" />
                <div class="info">
                    <p class="title">{{ str_limit($fl->display_address, $limit = 25, $end = '...') }}</p>
                    <p><i class="fa fa-tag"></i> ${{ $fl->rent }}</p>
                    <p>Freshness Score : 90%</p>
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ $fl->bedrooms }} Bed</li>
                        <li><i class="fa fa-bath"></i> {{ $fl->baths }} Bath</li>
                    </ul>
                    <p><i class="fa fa-map-marker-alt"></i> RealtyMX ID: mrgnyc_366577 · Auto Feed Mode</p>
                    <p>Posted: {{ date("m/d/y H:m A", strtotime($fl->created_at)) }}</p>
                    <a href="{{ route('admin.removeFeatured', $fl->id) }}" title="Remove this property from featured"><span class="status" style="background: red;">Remove Feature</span></a>
                    <div class="actions-btns">
                        <a href="{{ route('admin.repostListing', $fl->id) }}"><button type="button" class="border-btn">Repost</button></a>
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
