
<div class="property-listing">
    {{--Desktop View--}}
    <div class="desktop-listiing">
        @if(isset($listing->building->nearbyListings) && count($listing->building->nearbyListings) > 1)
            @foreach($listing->building->nearbyListings as $apartment)
                @if($listing->id === $apartment->id) @continue @endif
                {!! property_thumbs($apartment) !!}
            @endforeach
        @else
            No Nearby Apartment Found
        @endif
    </div>

    {{--Mobile View--}}
    <div class="owl-slider">
        <div class="owl-carousel owl-theme" id="NearbyApartments">
            @if( isset($listing->building->nearbyListings) && count($listing->building->nearbyListings) > 1)
                @foreach($listing->building->nearbyListings as $apartment)
                    @if($listing->id === $apartment->id) @continue @endif
                    <div class="item">
                        {!! property_thumbs($apartment) !!}
                    </div>
                @endforeach
            @else
                No Nearby Apartment Found
            @endif
        </div>
    </div>
</div>
