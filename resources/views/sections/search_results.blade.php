
<div class="search-bdr-top">
    <div class="mobile-view-dropdown">
        <i class="fa fa-bars"></i> Filters
    </div>
    <div class="mobile-map-icon"><i class="fas fa-map-marked-alt"></i></div>
    <div id="mobile-map-listing-view">
        <div id="mobile-map"></div>
    </div>
    <div class="row" id="mobile-tabs-collapse">
        <div class="listing-wrapp">
            <div class=" ">
                {{--Bedrooms--}}
                {!! Form::model(app('request')->all(), ['url' => route($filter_route, $param ?? null), 'method' => 'get', 'id' => 'search']) !!}
                <div class="dropdown-wrap">
                    @if($neigh_filter)
                        <div class="neighborhoods-dropdown-listings">
                            <button type="button" class="btn btn-primary" id="neigh-for-dropdown">{{ app('request')->get('neighborhood') ?? 'Neighborhood' }}</button>
                            <div class="dropdown-for-neigh dropdown-listiing-rent-page" id="advance-search-chkbox">
                                {!! filter_neighborhood_select() !!}
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="neighborhood" value="{{ request()->segment(2) }}">
                    @endif
                    <div class="main-search-beds">
                        <button type="button" class="btn btn-primary" id="beds-for-dropdown">Beds</button>
                        <div class="dropdown-for-beds dropdown-listiing-rent-page search-beds" id="advance-search-chkbox">
                            {!! multi_select_beds(5, app('request')->get('beds') ?? null) !!}
                        </div>
                    </div>
                    <div class="main-bath-search">
                        <button type="button" class="btn btn-primary" id="bath-for-dropdown">Baths</button>
                        <div class="dropdown-for-baths dropdown-listiing-rent-page search-bath" id="advance-search-chkbox">
                            {!! multi_select_baths(5, app('request')->get('baths') ?? null) !!}
                        </div>
                    </div>

                    <div class="dropdown-listing-price-wrapper">
                        <button type="button" class="btn btn-primary" id="price-for-dropdown">Price</button>
                        <div class="dropdown-for-price dropdown-listiing-rent-page" id="advance-search-chkbox">
                            <ul>
                                <li>
                                    {!! Form::text('min_price', null, ['class' => 'form-control', 'placeholder' => '$ min']) !!}
                                <li>To</li>
                                <li>
                                    {!! Form::text('max_price', null, ['class' => 'form-control', 'placeholder' => '$ max']) !!}
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#advance-search">More</button>
                    {!! Form::button('Search', ['class' => 'btn btn-primary text-right', 'type' => 'submit', 'style' => 'background:#213971;color:#ffff;']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="search-result-wrapper">
    <div class="search-listing">
        <h3></h3>
        <div id="boxscroll22">
            <div class="featured-properties" id="contentscroll22">
                <div class="property-listing neighbourhood-listing">
                    @foreach($data->listings as $listing)
                        <input type='hidden' name='map_location' value={{ $listing->map_location }}>
                        {!! property_thumbs($listing) !!}
                    @endforeach
                </div>
                <div class="property-listing mobile-listing">
                    <div class="owl-carousel owl-theme">
                        @foreach($data->listings as $listing)
                            <div class="items">
                                {!! property_thumbs($listing) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Desktop Map--}}
    @if(count($data->listings) > 0)
        <div class="map-wrapper">
            <div class="swipe-btn"><i class="fa fa-angle-left"></i></div>
            <div id="desktop-map"></div>
        </div>
    @endif
</div>


{{--Advance Search Modal--}}
@include('modals.advance_search')

{{--Check Availability--}}
@include('modals.check_availability')

{!! HTML::script('assets/js/input-to-dropdown.js') !!}
{!! HTML::script('assets/js/search-result.js') !!}
{!! HTML::style('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css') !!}
{!! HTML::script('https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js') !!}
<script>

    let coords = [];
    $('input[name=map_location]').each(function(i, v) {
        coords.push($(v).val());
    });

    @if(count($data->listings) > 0)
        if(coords !== []) {
            multiMarkers(coords, 'desktop-map', 8);
            multiMarkers(coords, 'mobile-map', 8);
        }
    @endif

    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").on('click', function () {
        let $body = $('body');
        $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
        $body.find('#desktop-map').remove();
        $body.find('#mobile-map').remove();
        $body.find('.map-wrapper').append(`<div id="mobile-map"></div>`);
        $body.find('.map-wrapper').append(`<div id="desktop-map"></div>`);
        setTimeout(() => {
            multiMarkers(coords, 'desktop-map', 10);
            multiMarkers(coords, 'mobile-map', 10);
        }, 100);
        $(".neighborhood-search .search-result-wrapper .search-listing").toggleClass('hide-list');
        $(".neighborhood-search .search-result-wrapper .map-wrapper").toggleClass('full-map');
    });

    $('body').on('change', '.sorting', function() {
        let url = window.location.origin;
        url = url.replace('/recent', '');
        url = url.replace('/cheapest', '');
        url = url.replace('/oldest', '');
        window.location.href = url+'/listing-by-rent/'+$(this).val();

    });

</script>
