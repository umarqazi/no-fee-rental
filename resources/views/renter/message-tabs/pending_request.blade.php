
@if($conversations->inactive->total() > 0)
    @foreach ($conversations->inactive as $request)
        <div class="message-row">
            <a href="{{ route('renter.loadConversation', $request->id) }}"><h3>{{ sprintf("%s %s", $request->sender->first_name ?? $request->username, $request->sender->last_name ?? null) }}</h3></a>
            <div class="property">
                <img src="{{ asset($request->listing->thumbnail ?? DLI ) }}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ str_formatting($request->listing->bedrooms, 'Bed') }}</li>
                        <li><i class="fa fa-bath"></i> {{ str_formatting($request->listing->baths, 'Bath') }}</li>
                    </ul>
                    <p>{{ is_exclusive($request->listing) }}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{ $request->listing->rent }}</div>
                </div>
            </div>
            <div class="date-text">
                {{ sprintf("%s on %s", ucfirst($request->appointment_time ?? 'Requested'), $request->appointment_date->format('D, d/m/y')) }}
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
