
<div class="col-md-3 col-sm-4">
    <h3>Unit Features</h3>
    @foreach($listing->features as $feature)
        <ul class="second-ul">
            <li>{{ ucwords($feature->name) }}</li>
        </ul>
    @endforeach
    @if(count($listing->features) < 1)
        <p>None</p>
    @endif
</div>
