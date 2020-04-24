
<div class="col-md-3 col-sm-4">
    <h3>Pet Policy</h3>
    <ul class="second-ul">
        @foreach($listing->pets as $pet)
            <li>{{ ucwords($pet->name) }}</li>
        @endforeach
    </ul>
    @if(count($listing->pets) < 1)
        <p>None</p>
    @endif
</div>
