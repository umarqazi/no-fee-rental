
<div class="col-md-4 col-sm-6">
    <h3>Building Features</h3>
    @if(isset($listing->building->amenities) && sizeof($listing->building->amenities) > 0  )
        <ul class="second-ul">
            @foreach($listing->building->amenities as $key => $amenity)
                <li>{{ ucwords($amenity->amenities) }}</li>
            @endforeach
        </ul>
    @else
        <p>None</p>
    @endif
</div>
