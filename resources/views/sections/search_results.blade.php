<div class="search-result-wrapper">
        <div class="search-listing">
            <div class="row">
                <div class="col-lg-12 listing-right-padd">
                    <div class="search-bdr-top">
                        <div class="mobile-view-dropdown">
                            <i class="fa fa-bars"></i> Filters
                        </div>
                        <div class="mobile-map-icon"><i class="fa fa-map-marker-alt"></i></div>
                        <div id="mobile-map-listing-view">
                            <div id="mobile-map"></div>
                        </div>
                        <div class="row" id="mobile-tabs-collapse">
                            <div class="listing-wrapp">
                                <div class=" ">
                                    {{--Bedrooms--}}
                                    {!! Form::open([]) !!}
                                    <div class="dropdown-wrap">
                                        <div class="radio-group-1 ">
                                            <div class="item">
                                                <label>Any
                                                    {!! Form::radio('beds', 'any') !!}
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            {!! Form::close() !!}
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
                                        <div class="radio-group-2 ">
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
            <h3>Manhattan, NY Rental</h3>
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
{!! HTML::script("https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js") !!}
<script>
    let coords = [];
    $('input[name=map_location]').each(function(i, v) {
        coords.push($(v).val());
    });
    inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
    inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
    if(coords !== []) {
        markerClusters(coords, document.getElementById('mobile-map'));
        markerClusters(coords, document.getElementById('desktop-map'));
    }

    $('body').on('change', '.sorting', function() {
        let url = window.location.href;
        url = url.replace('/recent', '');
        url = url.replace('/cheapest', '');
        url = url.replace('/oldest', '');
        window.location.href = `${url}/${$(this).val()}`;
    });
</script>
