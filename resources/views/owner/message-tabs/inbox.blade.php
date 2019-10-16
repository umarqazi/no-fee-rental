
{{--
@if( $data->appointments->active->total() > 0)
    @foreach ($data->appointments->active as $appointment)
--}}
        <div class="message-row row">
            <div class="col-sm-6 col-lg-10 col-12">
                <h3>{{--{{ $appointment->sender->first_name.' '.$appointment->sender->last_name }}--}}</h3>
            </div>
            <div class="col-sm-6 col-lg-2 col-12 view-buttons">
                <a href="{{--{{ route('agent.loadAppointmentChat', $appointment->id) }}--}}" class="view-chat-view"> View</a>
                <a href="{{--{{ route('agent.archiveAppointmentChat', $appointment->id) }}--}}" class="view-chat-archive"> Archive Chat</a>
            </div>
            <div class="property">
                <img src="{{--{{ asset($appointment->listing->thumbnail ?? DLI) }}--}}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i> {{--{{ str_formatting($appointment->listing->bedrooms, 'Bed') }}--}}</li>
                        <li><i class="fa fa-bath"></i> {{--{{ str_formatting($appointment->listing->baths, 'Bath') }}--}}</li>
                    </ul>
                    <p>{{--{{ is_exclusive($appointment->listing) }}--}}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{--{{ $appointment->listing->rent }}--}}</div>
                </div>
            </div>
            <div class="date-text">
               {{-- {{ $appointment->appointment_date->format('D, d/m/y').' '.$appointment->appointment_time->format('h:i a') }}--}}
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
