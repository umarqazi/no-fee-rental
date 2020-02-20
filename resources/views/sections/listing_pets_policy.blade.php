
<div class="col-md-3 col-sm-4">
    <h3>Pet Policy</h3>
    @php $pet = petPolicy($listing->features); @endphp
    @if(count($pet) < 1)
        <p>None</p>
    @endif
    @foreach($pet as $feature)
        <ul class="second-ul">
            <li>{{ ucwords($feature) }}</li>
        </ul>
    @endforeach
</div>
