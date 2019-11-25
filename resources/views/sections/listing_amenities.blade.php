
<div class="col-md-3 col-sm-4">
    <h3>Amenities</h3>
    @if(isset($listing->building->amenities) && sizeof($listing->building->amenities) > 0  )
        @foreach($listing->building->amenities as $amenity)
            <ul class="second-ul">
                <li>{{ $amenity->amenities }}</li>
            </ul>
        @endforeach
    @else
        None
    @endif
</div>