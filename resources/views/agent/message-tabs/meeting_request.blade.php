
@if( $data->appointments->inactive->total() > 0)
    @foreach ($data->appointments->inactive as $request)
        <div class="message-row">
            <h3>{{ $request->sender->first_name.' '.$request->sender->last_name }}</h3>
            <p>Reminder from nofeerentals: You have still not replied to {{ $request->sender->first_name }} in regards Reminder from RentHop<a href="" data-toggle="modal" data-target="#message-modal">Read More</a></p>
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
                {{ $request->appointment_date->format('D, d/m/y').' '.$request->appointment_time->format('h:i a') }}
            </div>
            <div class="actions-btns">
                <button class="border-btn" request_id="{{ $request->id }}" id="reply">Reply</button>
                <button class="border-btn">Deny</button>
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
