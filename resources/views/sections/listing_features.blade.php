
<div class="col-md-4 col-sm-6">
    <h3>Unit Features</h3>
    <ul class="second-ul">
        @foreach($listing->features as $feature)
            <li>{{ ucwords($feature->name) }}</li>
        @endforeach
    </ul>
    @if(count($listing->features) < 1)
        <p>None</p>
    @endif
</div>
