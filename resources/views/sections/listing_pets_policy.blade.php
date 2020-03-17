
<div class="col-md-3 col-sm-4">
    <h3>Pet Policy</h3>
    @foreach($listing->pets as $pet)
        <ul class="second-ul">
            <li>{{ ucwords($pet->name) }}</li>
        </ul>
    @endforeach
    @if(count($listing->pets) < 1)
        <p>None</p>
    @endif
</div>
