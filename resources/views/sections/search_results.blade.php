<div class="search-bdr-top-wrapper">
    <div class="search-bdr-top">
        <div class="mobile-view-dropdown">
            <i class="fa fa-bars"></i> Filters
        </div>
        <div class="mobile-map-icon"><i class="fas fa-map-marked-alt"></i></div>
        <div id="mobile-map-listing-view">
            <div id="mobile-map"></div>
        </div>
        <div class="row">
            <div id="mobile-tabs-collapse">
                <div class="mobile-tabs-collapse-inner">
                    <div class="listing-wrapp">
                        {{--Bedrooms--}}
                        {!! Form::model(app('request')->all(), ['url' => route($route, $params ?? null), 'method' => 'get', 'id' => 'search']) !!}
                        <div class="dropdown-wrap">
                            @if($neigh_filter)
                                <div class="neighborhoods-dropdown-listings">
                                    <button type="button" class="btn btn-primary neighborhood-field PN" id="neigh-for-dropdown">
                                        {{ is_array(app('request')->get('neighborhood'))
                                            ? sprintf("Neighborhoods (%s)", count(app('request')->get('neighborhood')))
                                            : app('request')->get('neighborhood') ?? 'Neighborhoods' }}
                                    </button>
                                    <div class="dropdown-for-neigh dropdown-listiing-rent-page search-result-section-neighborhood" id="neighborhood-searchchecbox">
                                        {!! filter_neighborhood_select(app('request')->get('neighborhood')) !!}
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="neighborhood" value="{{ request()->get('neighborhood') }}">
                            @endif
                            <div class="main-search-beds">
                                <button type="button" class="btn btn-primary" id="beds-for-dropdown">Beds</button>
                                <div class="dropdown-for-beds dropdown-listiing-rent-page search-beds PBD" id="advance-search-chkbox">
                                    {!! multi_select_beds(5, app('request')->get('beds') ?? null) !!}
                                </div>
                            </div>
                            <div class="main-bath-search">
                                <button type="button" class="btn btn-primary" id="bath-for-dropdown">Baths</button>
                                <div class="dropdown-for-baths dropdown-listiing-rent-page search-bath PBA" id="advance-search-chkbox">
                                    {!! multi_select_baths(5, app('request')->get('baths') ?? null) !!}
                                </div>
                            </div>

                            <div class="dropdown-listing-price-wrapper">
                                <button type="button" class="btn btn-primary" id="price-for-dropdown">Price</button>
                                <div class="dropdown-for-price dropdown-listiing-rent-page" id="advance-search-chkbox">
                                    <ul>
                                        <li>
                                        {!! Form::text('min_price', Null,['class' => 'form-control PPm', 'placeholder' => '$ min']) !!}
                                        <li>To</li>
                                        <li>
                                        {!! Form::text('max_price', Null, ['class' => 'form-control PPM', 'placeholder' =>'$ max']) !!}
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary advance-search" data-toggle="modal" data-target="#advance-search">More</button>
                            {!! Form::button('Search', ['class' => 'btn btn-primary text-right', 'type' => 'submit', 'style'
                            => 'background:#f36f21;color:#ffff; border-color:#f36f21; padding-left:35px; padding-right:35px;'])
                            !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="sortBy-listing">
                        <div class="form-group sortBy-wraper">
                            <label for="sortBy">Sort By:</label>
                            {!! Form::select('sortBy', config('formfields.sortBy'), request()->get('sortBy') ?? null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="search-result-wrapper">
        <div class="search-listing">
            <h3></h3>
            <div id="boxscroll-section">
                <div class="featured-properties" id="contentscroll-sec">
                    <div class="property-listing neighbourhood-listing">
                        @foreach($listings as $listing)
                            {!! property_thumbs($listing, true) !!}
                        @endforeach
                        @if(count($listings) < 1)
                            <div class="no-result-found-search">
                                <p>No results found</p>
                            </div>
                        @endif
                    </div>
                    <div class="property-listing mobile-listing">
                        @if(count($listings) > 0)
                        <div class="owl-carousel owl-theme">
                            @foreach($listings as $listing)
                                <div class="items">
                                    {!! property_thumbs($listing, true) !!}
                                </div>
                            @endforeach
                        </div>
                        @else
                            <div class="no-result-found-search">
                                <p>No results found</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--Desktop Map--}}
        @if(count($listings) > 0)
            <div class="map-wrapper">
                <div class="swipe-btn"><i class="fa fa-angle-left"></i></div>
                <div id="desktop-map"></div>
            </div>
        @endif
    </div>
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

    window.onload = () => { drawCoords(); };

    let nextPage = insertParam(`page`, 2);
    let url = new URL(document.location.href).pathname;
    url = url + '?' + nextPage;

    $('#boxscroll-section').scroll(function () {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            if(nextPage !== null) {
                nextPage = null;
                ajaxRequest(`${url}`, 'post', null).then(res => {
                    nextPage = res.data.next_page_url;
                    url = window.location.pathname + '?' + nextPage.split('?')[1];
                    console.log(url);
                    res.data.data.forEach(v => {
                        $('.property-listing > .property-thumb:last').after(property_thumb(v));
                    });
                    drawCoords();
                });
            }
        }
    });

    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").on('click', function () {
        let $body = $('body');
        $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
        $body.find('#desktop-map').remove();
        $body.find('.map-wrapper').append(`<div id="desktop-map"></div>`);
        setTimeout(() => { drawCoords(); }, 100);
        $(".neighborhood-search .search-result-wrapper .search-listing").toggleClass('hide-list');
        $(".neighborhood-search .search-result-wrapper .map-wrapper").toggleClass('full-map');
    });

    $('body').on('change', 'select[name=sortBy]', function() {
        document.location.search = insertParam('sortBy', $(this).val());
    });

    $('.search-result-section-neighborhood').find('ul > li > div > input').on('click', function() {
        $('.neighborhood-field').text($(this).val());
    });
</script>
