@extends('secured-layouts.app')
@section('title', 'Renter')
@section('content')
    <div class="wrapper">
        <div class="heading-wrapper">
            <h1>Wishlist</h1>
        </div>
        <div class="block listing-container">
            <div class="heading-wrapper pl-0">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#listing-active">Active ({{ sizeof($favourites->active[0]->favourite)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#listing-inactive">Closed ({{ sizeof($favourites->inactive[0]->favourite)}})</a>
                    </li>
                </ul>
                <div class="filter-wrapper">
                    <div class="listing-views">
                        <span><i class="fa fa-th-list list-view-btn active"></i></span>
                        <span><i class="fa fa-th grid-view-btn"></i></span>
                    </div>
                </div>
            </div>
            <div class="block-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="listing-active">
                        {{--@include('listing-features.active_listing')--}}

                        <!--List view listing-->
                            <div class="listing-wrapper">
                                @foreach($favourites->active[0]->favourite as $al)
                                    <div class="listing-row">
                                        <div class="img-holder">
                                            <img src="{{ asset($al->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                                        </div>
                                        <div class="info">
                                            <p class="title">{{ str_limit(is_exclusive($al), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                                            <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                                            <p>Freshness Score : 90%</p>
                                            <ul>
                                                <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                                                <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                                            </ul>
                                            {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
                                            <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                                                <span class="status" style="background: red;">Remove</span>
                                             <div class="actions-btns">
                                                <a href="{{ route('listing.detail', $al->id) }}">
                                                    <i class="fa fa-eye" style="font-size: 24px;position: relative;top: 5px;"></i>
                                                </a>
                                                 <a href="{{ route('web.removeFavouriteListing', $al->id) }}" title="Remove From Favourite">
                                                     <button type="button" class="border-btn">Remove</button>
                                                 </a>
                                             </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if(sizeof($favourites->active[0]->favourite) < 1)
                                    <p class="null">No Record Found</p>
                                @endif
                                {{--{!! $favourites->active->render() !!}--}}
                            </div>


                            <!--Grid view listing-->
                            <div class="grid-view-wrapper">
                                <div class="row">
                                    @foreach($favourites->active[0]->favourite as $al)
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="listing-thumb">
                                                <img src="{{ asset( $al->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                                                <div class="info">
                                                    <p class="title">
                                                        {{ str_limit(is_exclusive($al), STR_LIMIT_GRID_VIEW, ' ...') }}
                                                    </p>
                                                    <p><i class="fa fa-tag"></i> ${{ ($al->rent) ?   number_format($al->rent,0) : 'None' }}</p>
                                                    <p>Freshness Score : 90%</p>
                                                    <ul>
                                                        <li><i class="fa fa-bed"></i> {{ str_formatting($al->bedrooms, 'Bed') }}</li>
                                                        <li><i class="fa fa-bath"></i> {{ str_formatting($al->baths, 'Bath') }}</li>
                                                    </ul>
                                                    {!! $al->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$al->realty_id}</p>" : '' !!}
                                                    <p>Posted On: {{ $al->created_at->format("m/d/y H:m A") }}</p>
                                                        <span class="status" style="background: red;">Remove</span>
                                                    <div class="actions-btns">
                                                    <div class="list-actions-icons">
                                                        <a href="{{ route('listing.detail', $al->id) }}"><button><i class="fa fa-eye"></i></button></a>
                                                    </div>
                                                    <a href="{{ route('web.removeFavouriteListing', $al->id) }}" title="Remove From Favourite">
                                                        <button type="button" class="border-btn">Remove</button>
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if(sizeof($favourites->active[0]->favourite) < 1)
                                        <p class="null">No Record Found</p>
                                    @endif
                                </div>
                           {{--     {!! $favourites->active[0]->favourite->render() !!}
                           --}} </div>

                    </div>
                    <div class="tab-pane fade" id="listing-inactive">

                        <!--List view listing-->
                        <div class="listing-wrapper">
                            @foreach($favourites->inactive[0]->favourite as $il)
                                <div class="listing-row">
                                    <div class="img-holder">
                                        <img src="{{ asset( $il->thumbnail ?? DLI ) }}" alt="" style="height:205px;" class="main-img" />
                                    </div>
                                    <div class="info">
                                        <p class="title">{{ str_limit(is_exclusive($il), STR_LIMIT_LIST_VIEW, ' ...') }}</p>
                                        <p><i class="fa fa-tag"></i> ${{ ($il->rent) ?   number_format($il->rent,0) : 'None' }}</p>
                                        <p>Freshness Score : 90%</p>
                                        <ul>
                                            <li><i class="fa fa-bed"></i> {{ str_formatting($il->bedrooms, 'Bed') }}</li>
                                            <li><i class="fa fa-bath"></i> {{ str_formatting($il->baths, 'Bath') }}</li>
                                        </ul>
                                        {!! $il->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$il->realty_id}</p>" : '' !!}
                                        <p>Posted On: {{ $il->created_at->format("m/d/y H:m A") }}</p>
                                            <span class="status" style="background: red;">Remove</span>
                                    <div class="actions-btns">
                                        <a href="{{ route('web.removeFavouriteListing', $il->id) }}" title="Remove From Favourite">
                                            <button type="button" class="border-btn">Remove</button>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(sizeof($favourites->inactive[0]->favourite) < 1)
                                <p class="null">No Record Found</p>
                            @endif
                        </div>

                        <!--Grid view listing-->
                        <div class="grid-view-wrapper">
                            <div class="row">
                                @foreach($favourites->inactive[0]->favourite as $il)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="listing-thumb">
                                            <img src="{{ asset( $il->thumbnail ?? DLI ) }}" alt="" style="height:205px;" class="main-img" />
                                            <div class="info">
                                                <p class="title">{{ str_limit(is_exclusive($il), STR_LIMIT_GRID_VIEW, ' ...') }}</p>
                                                <p><i class="fa fa-tag"></i> ${{ ($il->rent) ?   number_format($il->rent,0) : 'None' }}</p>
                                                <p>Freshness Score : 90%</p>
                                                <ul>
                                                    <li><i class="fa fa-bed"></i> {{ str_formatting($il->bedrooms, 'Bed') }}</li>
                                                    <li><i class="fa fa-bath"></i> {{ str_formatting($il->baths, 'Bath') }}</li>
                                                </ul>
                                                {!! $il->realty_id ? "<p><i class='fa fa-map-marker-alt'></i> RealtyMX ID: {$il->realty_id}</p>" : '' !!}
                                                <p>Posted On: {{ $il->created_at->format("m/d/y H:m A") }}</p>
                                                    <span class="status" style="background: red;">Remove</span>
                                            <div class="actions-btns">
                                                <a href="{{ route('web.removeFavouriteListing', $il->id) }}" title="Remove From Favourite">
                                                    <button type="button" class="border-btn">Remove</button>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if(sizeof($favourites->active[0]->favourite) < 1)
                                    <p class="null">No Record Found</p>
                                @endif
                            </div>
                            {!! $favourites->inactive->render() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! HTML::script('assets/js/listing.js') !!}
@endsection
