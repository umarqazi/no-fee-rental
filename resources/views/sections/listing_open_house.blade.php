
@foreach($listing->openHouses as $openHouse)
    @if(carbon($openHouse->date)->format('m-d-Y') > now()->format('m-d-Y') && daysNumReadable(carbon($openHouse->date)) < 8)
        <h3> Open House</h3>
        <div class="open-house-inner">
            <div class="open-timings">
                <p>{{ formattedDate('D, M d' ,$openHouse->date). ' | '.openHouseTimeSlot($openHouse->start_time)->format('h:i a'). ' - ' .openHouseTimeSlot($openHouse->end_time)->format('h:i a') }}</p>
            </div>
            <div class="apointment-interest-section">
                @if($openHouse->only_appt)
                    <span> (By appointment only)</span>
                @else
                    <button class="btn btn-default">Interested</button>
                @endif
                {{--                                        <div class="request-send">--}}
                {{--                                        <i class="fas fa-check-circle"></i>Request Sent--}}
                {{--                                        </div>--}}
            </div>
        </div>
        @break
    @endif
@endforeach