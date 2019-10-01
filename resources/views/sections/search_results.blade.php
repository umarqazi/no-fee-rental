<div class="container-lg">
    <div class="search-result-wrapper">
        <div class="search-listing">
            <div class="row">
                <div class="search-bdr-top col-lg-12">
                    <div class="mobile-view-dropdown">
                        <i class="fa fa-bars"></i> Filters
                    </div>
                    <div class="mobile-map-icon"><i class="fa fa-map-marker-alt"></i></div>
                    <div id="mobile-map-listing-view">
                        <div id="mobile-map"></div>
                    </div>
                    <div class="row" id="mobile-tabs-collapse">
                        <div class="col-lg-7 col-12 ">
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
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-lg-5 col-12">
                            <div class="sort-by-wrapper">
                                <div class="sort-by">
                                    <span>Sort By: </span>
                                    {!! Form::select('sorting',
                                        [
                                            ''          => '-- Select --',
                                            'recent'    => 'Recent',
                                            'cheaper'   => 'Cheapest',
                                            'petPolicy' => 'Pet Policy'
                                        ],
                                        request()->get('recent') ??
                                        request()->get('petPolicy') ??
                                        request()->get('cheaper'), ['class' => "custom-select-list sorting"]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! listingView($data->listings) !!}
        </div>

        {{--Desktop Map--}}
        @if(count($data->listings) > 0 && $showMap)
            <div class="map-wrapper">
                <div class="swipe-btn"><i class="fa fa-angle-left"></i></div>
                    <div id="desktop-map"></div>
                </div>
            </div>
        @endif

</div>
{{--Advance Search Modal--}}
@include('modals.advance_search')
{!! HTML::script('assets/js/neighborhoods.js') !!}
{!! HTML::script('assets/js/input-to-dropdown.js') !!}
{!! HTML::script("https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js") !!}
<script>
    let coords = $('input[name=map_location]').val();
    inputsToDropdown('.radio-group-1', 'Beds', 'radio', '.radio-group-1', '');
    inputsToDropdown('.radio-group-2', 'Baths', 'radio', '.radio-group-2', '');
    @if($showMap)
        if(coords !== undefined) {
            markerClusters(coords, document.getElementById('mobile-map'));
            markerClusters(coords, document.getElementById('desktop-map'));
        }
    @endif
</script>
