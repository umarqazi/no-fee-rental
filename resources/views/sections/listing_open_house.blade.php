
<h3> Open House</h3>
@if(isOpenToday($listing->openHouse))
    <div class="open-house-inner">
        <div class="open-timings">
            <p>{{ formattedDate('D, M d', $listing->openHouse->date). ' | '.openHouseTimeSlot($listing->openHouse->start_time)->format('h:i a'). ' - ' .openHouseTimeSlot($listing->openHouse->end_time)->format('h:i a') }}</p>
        </div>
        <div class="apointment-interest-section">
            @if($listing->openHouse->only_appt)
                <span> (By appointment only)</span>
            @else
                <button class="btn btn-default">Interested</button>
            @endif
            {{--                                        <div class="request-send">--}}
            {{--                                        <i class="fas fa-check-circle"></i>Request Sent--}}
            {{--                                        </div>--}}
        </div>
    </div>
@endif
