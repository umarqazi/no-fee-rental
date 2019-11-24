
<div class="property-listing">
    {{--Desktop View--}}
    <div class="desktop-listiing">
        @if(isset($listing->building->listings) && count($listing->building->listings) > 1)
            @foreach($listing->building->listings as $apartment)
                @if($listing->id === $apartment->id) @continue @endif
                <div class="property-thumb">
                    <div class="check-btn">
                        <a href="javascript:void(0);">
                            <button class="btn-default" data-toggle="modal" data-target="#check-availability">
                                Check Availability
                            </button>
                        </a>
                    </div>
                    @if(!authenticated())
                        <span class="display-heart-icon"></span>
                    @endif
                    @if(isRenter())
                        @if(isFavourite($apartment["favourites"],$apartment->id))
                            <span id = "{{$apartment->id}}" class="heart-icon favourite"></span>
                        @else
                            <span id = "{{$apartment->id}}" class="heart-icon "></span>
                        @endif
                    @endif
                    <img src="{{ asset($apartment->thumbnail ?? DLI) }}" alt="" class="main-img">
                    <div class="info">
                        <div class="info-link-text">
                            <p> ${{ ($apartment->rent) ?   number_format($apartment->rent,0) : 'None' }} </p>
                            <small>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }} </small>
                            <p> {{ is_exclusive($apartment) }}</p>
                        </div>
                        <a href="{{ route('listing.detail', $apartment->id) }}" class="btn viewfeature-btn"> View </a>
                    </div>
                    <div class="feaure-policy-text">
                        <p>${{ ($apartment->rent) ?   number_format($apartment->rent,0) : 'None' }} / Month </p>
                        <span>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }}</span>
                    </div>
                </div>
            @endforeach
        @else
            No Nearby Apartment Found
        @endif
    </div>

    {{--Mobile View--}}
    <div class="owl-slider">
        <div class="owl-carousel owl-theme" id="NearbyApartments">
            @if( isset($listing->building->listings) && count($listing->building->listings) > 1)
                @foreach($listing->building->listings as $apartment)
                    @if($listing->id === $apartment->id) @continue @endif
                    <div class="item">
                        <div class="property-thumb">
                            <div class="check-btn">
                                <a href="javascript:void(0);">
                                    <button class="btn-default" data-toggle="modal" data-target="#check-availability">Check Availability</button>
                                </a>
                            </div>
                            @if(!authenticated())
                                <span class="display-heart-icon"></span>
                            @endif
                            @if(isRenter())
                                @if(isFavourite($apartment["favourites"],$apartment->id))
                                    <span id = "{{$apartment->id}}" class="heart-icon favourite"></span>
                                @else
                                    <span id = "{{$apartment->id}}" class="heart-icon "></span>
                                @endif
                            @endif
                            <img src="{{ asset($apartment->thumbnail ?? DLI) }}" alt="" class="main-img">
                            <div class="info">
                                <div class="info-link-text">
                                    <p> ${{ ($apartment->rent) ?   number_format($apartment->rent,0) : 'None' }} </p>
                                    <small>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }} </small>
                                    <p> {{ is_exclusive($apartment) }}</p>
                                </div>
                                <a href="{{ route('listing.detail', $apartment->id) }}" class="btn viewfeature-btn"> View </a>
                            </div>
                            <div class="feaure-policy-text">
                                <p>${{ ($apartment->rent) ?   number_format($apartment->rent,0) : 'None' }} / Month </p>
                                <span>{{ str_formatting($apartment->bedrooms, 'Bed').' ,'.str_formatting($apartment->baths, 'Bath') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                No Nearby Apartment Found
            @endif
        </div>
    </div>
</div>
