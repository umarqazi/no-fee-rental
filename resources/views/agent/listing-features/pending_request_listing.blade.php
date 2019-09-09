
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($listing->pending as $al)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{isset($al->thumbnail) ? ((!empty($al->realty_id)) ? $al->thumbnail : asset('storage/'.$al->thumbnail)) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $al->display_address }}</p>
                <p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
                <p>Freshmen Score : 90%</p>
                <ul>
                    <li><i class="fa fa-bed"></i> {{ $al->bedrooms }} Bed</li>
                    <li><i class="fa fa-bath"></i> {{ $al->baths }} Bath</li>
                </ul>
                <p>Posted: {{ date("m/d/y H:m A", strtotime($al->created_at)) }}</p>
                <span class="status" style="background: yellow;">Pending</span>
                @if($al->is_featured != 0)
                    <span class="status" style="margin-right: 60px;background: blueviolet;">{{($al->is_featured == 2) ? 'Requested for feature' : 'Featured' }}</span>
                @endif
                <div class="actions-btns">
                    <a href="{{ route('agent.editListing', $al->id) }}"><span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span></a>

                    <a href="{{ route('agent.copyListing', $al->id) }}"><span><img src="{{asset('assets/images/copy-icon.png')}}" alt=""></span></a>
                    <a href="{{ route('agent.listingRepost', $al->id) }}"><button type="button" class="border-btn">Repost</button></a>
                    @if($al->is_featured != 1 && $al->is_featured != 2)
                        <a href="{{ route('agent.requestFeatured', $al->id) }}"><button type="button" class="border-btn">Request Feature</button></a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if($listing->pending->total() < 1)
        No Record Found
    @endif
    {!! $listing->pending->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($listing->pending as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{isset($al->thumbnail) ? ((!empty($al->realty_id)) ? $al->thumbnail : asset('storage/'.$al->thumbnail)) : asset('uploads/listing/thumbnails/default.jpg')}}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">{{ $al->display_address }}</p>
                        <p><i class="fa fa-tag"></i> ${{ $al->rent }}</p>
                        <p>Freshmen Score : 90%</p>
                        <ul>
                            <li><i class="fa fa-bed"></i> {{ $al->bedrooms }} Bed</li>
                            <li><i class="fa fa-bath"></i> {{ $al->baths }} Bath</li>
                        </ul>
                        <p>Posted: {{ date("m/d/y H:m A", strtotime($al->created_at)) }}</p>
                        <span class="status" style="background: yellow;">Pending</span>
                        @if($al->is_featured != 0)
                            <span class="status" style="margin-right: 60px;background: blueviolet;">{{($al->is_featured == 2) ? 'Requested for feature' : 'Featured' }}</span>
                        @endif
                        <div class="actions-btns">
                            <a href="{{ route('agent.listingRepost', $al->id) }}"><button type="button" class="border-btn">Repost</button></a>
                            @if($al->is_featured != 1 && $al->is_featured != 2)
                                <a href="{{ route('agent.requestFeatured', $al->id) }}"><button type="button" class="border-btn">Request Feature</button></a>
                            @endif
                        </div>
                        <div class="list-actions-icons">
                            <a href="{{ route('agent.editListing', $al->id) }}"><button><i class="fa fa-edit"></i></button></a>
                            <a href="{{ route('agent.copyListing', $al->id) }}"><button><i class="fa fa-copy"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($listing->pending->total() < 1)
            No Record Found
        @endif
    </div>
    {!! $listing->pending->render() !!}
</div>
