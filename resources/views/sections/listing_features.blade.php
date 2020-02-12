
<div class="col-md-3 col-sm-4">
    <h3>Unit Features</h3>
    @php $unit = unitFeature($listing->features); @endphp
    @if(count($unit) < 1)
        <p>None</p>
    @endif
    @foreach($unit as $feature)
        <ul class="second-ul">
            <li>{{ $feature }}</li>
        </ul>
    @endforeach
</div>
