<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
{{--<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->--}}
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src='https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js'></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.4.0/mapbox-gl-csp-worker.js.map"></script>
<div class="search-result-wrapper">
        <div class="search-listing">
            <div class="row">
                <div class="col-lg-12 listing-right-padd">
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
                                    {!! Form::open([]) !!}
                                    <div class="dropdown-wrap">
                                        <div class="radio-group-1 tabs" id="beds">
                                            <div class="item">
                                                <label>Any
                                                    {!! Form::radio('beds', 'any') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            {{--{!! Form::close() !!}--}}
                                            <div class="item">
                                                <label>Studio
                                                    {!! Form::radio('beds', 'studio') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>1
                                                    {!! Form::radio('beds', '1') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>2
                                                    {!! Form::radio('beds', '2') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>3
                                                    {!! Form::radio('beds', '3') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        {{--BathRooms--}}
                                        <div class="radio-group-2 tabs" id="baths">
                                            <div class="item">
                                                <label>Any
                                                    {!! Form::radio('baths', 'any') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>1
                                                    {!! Form::radio('baths', '1') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>2
                                                    {!! Form::radio('baths', '2') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="item">
                                                <label>3
                                                    {!! Form::radio('baths', '3') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="price-dropdown">
                                            <a href="javascript:void(0);" class="btn btn-default" data-toggle="modal" data-target="#advance-search">
                                                More
                                            </a>
                                        </div>
                                        <!-- <div class="search-btn">
                                            <button type="submit" class="btn btn-default">Search </button>
                                        </div> -->
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="">
                                    <div class="sort-by-wrapper">
                                        <div class="sort-by">
                                            <span>Sort By: </span>
                                            {!! Form::select('sorting',
                                                [
                                                    ''         => 'Select',
                                                    'recent'   => 'Recent',
                                                    'cheapest' => 'Cheapest',
                                                    'oldest'   => 'Oldest'
                                                ],
                                                $sort ?? null,
                                                ['class' => "custom-select-list sorting"]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3></h3>
            <span>{{ count($data->listings) }} places available for rent </span>
            <div id="boxscroll22">
                <div class="featured-properties" id="contentscroll22">
                    <div class="property-listing neighbourhood-listing">
                        @foreach($data->listings as $listing)
                            <input type='hidden' name='map_location' value={{ $listing->map_location }}>
                            <div class='property-thumb'>
                                <div class='check-btn'>
                                    <button class='btn-default' list_id="{{ $listing->id }}" to="{{ $listing->agent->id }}" data-target='#check-availability'>
                                        Check Availability
                                    </button>
                                </div>
                                @if(!authenticated())
                                    <span class="display-heart-icon"></span>
                                @endif
                                @if(isRenter())
                                    @if(isFavourite($listing["favourites"],$listing->id))
                                        <span id = "{{$listing->id}}" class="heart-icon favourite"></span>
                                    @else
                                        <span id = "{{$listing->id}}" class="heart-icon "></span>
                                    @endif
                                @endif
                                <img src='{{ asset($listing->thumbnail ?? DLI) }}' alt="" class='main-img'>
                                <div class='info'>
                                    <div href='javascript:void(0);' class='info-link-text'>
                                        <p> ${{ ($listing->rent) ?   number_format($listing->rent,0) : 'None' }} </p>
                                        <small>{{ str_formatting($listing->bedrooms, ' Bed').', '.str_formatting($listing->baths, ' Bath') }}</small>
                                        <p> {{ is_exclusive($listing).', '. $listing->neighborhood->name }} </p>
                                    </div>
                                    <a href="{{ route('listing.detail', $listing->id) }}" class='btn viewfeature-btn'> View </a>
                                </div>
                                <div class='feaure-policy-text'>
                                    <p>${{ ($listing->rent) ?   number_format($listing->rent,0) : 'None' }} / Month </p>
                                    <span>{{ str_formatting($listing->bedrooms, ' Bed').', '.str_formatting($listing->baths, ' Bath') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="property-listing mobile-listing">
                        <div class="owl-carousel owl-theme">
                            @foreach($data->listings as $listing)
                                <div class="items">
                                    <div class='property-thumb'>
                                        <div class='check-btn'>
                                            <button class='btn-default'  list_id="{{ $listing->id }}" to="{{ $listing->agent->id }}" data-target='#check-availability'>
                                                Check Availability
                                            </button>
                                        </div>
                                        @if(!authenticated())
                                            <span class="display-heart-icon"></span>
                                        @endif
                                        @if(isRenter())
                                            @if(isFavourite($listing["favourites"],$listing->id))
                                                <span id = "{{$listing->id}}" class="heart-icon favourite"></span>
                                            @else
                                                <span id = "{{$listing->id}}" class="heart-icon "></span>
                                            @endif
                                        @endif
                                        <img src='{{ asset($listing->thumbnail ?? DLI) }}' alt="" class='main-img'>
                                        <div class='info'>
                                            <div href='javascript:void(0);' class='info-link-text'>
                                                <p> $ {{ ($listing->rent) ?   number_format($listing->rent,0) : 'None' }} </p>
                                                <small>{{ str_formatting($listing->bedrooms, ' Bed').', '.str_formatting($listing->baths, ' Bath') }}</small>
                                                <p> {{ is_exclusive($listing).', '.  $listing->neighborhood->name }} </p>
                                            </div>
                                            <a href="{{ route('listing.detail', $listing->id) }}" class='btn viewfeature-btn'> View </a>
                                        </div>
                                        <div class='feaure-policy-text'>
                                            <p>${{ ($listing->rent) ?   number_format($listing->rent,0) : 'None' }} / Month </p>
                                            <span>{{ str_formatting($listing->bedrooms, ' Bed').', '.str_formatting($listing->baths, ' Bath') }}</span>
                                        </div>
                                    </div>
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

{!! HTML::script('assets/js/neighborhoods.js') !!}
{!! HTML::script('assets/js/input-to-dropdown.js') !!}
<script>
    let coords = [];
    $('input[name=map_location]').each(function(i, v) {
        coords.push($(v).val());
    });
    if(sessionStorage.getItem("beds")){
        inputsToDropdown('.radio-group-1', sessionStorage.getItem("beds"), 'radio', '.radio-group-1', '');
    }
    else  {
        inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
    }
    if(sessionStorage.getItem("baths")){
        inputsToDropdown('.radio-group-2', sessionStorage.getItem("baths") , 'radio', '.radio-group-2', '');
    }
    else  {
        inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
    }

    if(coords !== []) {
        multiMarkers(coords, 'desktop-map');
        multiMarkers(coords, 'mobile-map');
    }

    $(".neighborhood-search .search-result-wrapper .map-wrapper .swipe-btn").on('click', function () {
        $(this).find('i').toggleClass('fa-angle-left fa-angle-right');
        multiMarkers(coords, 'desktop-map', 15);
        multiMarkers(coords, 'mobile-map', 15);
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

    $('.tabs > div > ul').find('a').on('click', function() {
        let url = window.location.origin;
        let value = $(this.childNodes[0]).val();
        let id = $(this).parent().parent().parent().parent().attr('id');
        if(id == 'beds'){
            if(sessionStorage.getItem("baths")){
                window.location.href = url+'/listing-by-rent-filter/'+value+'/'+sessionStorage.getItem("baths") ;
                sessionStorage.setItem("beds", value);
            }
            else {
                window.location.href = url+'/listing-by-rent-filter/'+value;
                sessionStorage.setItem("beds", value);
            }
        }
        else{
            if(sessionStorage.getItem("beds")){
                window.location.href = url+'/listing-by-rent-filter/'+sessionStorage.getItem("beds")+'/'+value ;
                sessionStorage.setItem("baths", value);
            }
            else {
                window.location.href = url+'/listing-by-rent-filter/'+value;
                sessionStorage.setItem("baths", value);
            }
        }
    });

</script>
