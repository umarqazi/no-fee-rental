
@if($listing->agent->id !== myId())
    <div class="calendar-wrap">
        <!--calendar slider -->
        <h3>Request for Schedule </h3>
        {!! Form::open(['url' => route('web.makeAppointment')]) !!}
        {!! Form::hidden('to', $listing->agent->id) !!}
        {!! Form::hidden('listing_id', $listing->id) !!}
        <div class="calendarCarasoule">
            <div class="owl-carousel owl-theme" id="calendar-slider">
                @for($i = 0; $i < 14; $i ++)
                    @php $date = now()->addDay($i); @endphp
                    <div class="item">
                        <div class="appointment-radio-btn">
                            <div class="selection">
                                {!! Form::radio('appointment_date', $date->format('Y-m-d'), false, ['id' => "date{$i}"]) !!}
                                <label for="date{{ $i }}">{{ $date->format('l') }} <br>
                                    <span> {{ $date->format('d') }} </span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="appointment-radio-btn">
            <div class="selection">
                <input id="Morning" name="appointment_time" value="10:00 am" type="radio">
                <label for="Morning">Morning <br>
                    10am - 12pm
                </label>
            </div>
            <div class="selection">
                <input id="Afternoon" name="appointment_time" value="12:00 pm" type="radio">
                <label for="Afternoon">Afternoon <br>
                    12pm - 3pm
                </label>
            </div>
            <div class="selection">
                <input id="Evening" name="appointment_time" value="03:00 pm" type="radio">
                <label for="Evening">Evening <br>
                    3pm - 6pm
                </label>
            </div>
        </div>
        <div class="after-radio-textarea">
            {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) !!}
            <button type="submit"><img src="{{ asset('assets/images/send-msg.png') }}" alt="" /></button>
        </div>
        {!! Form::close() !!}
    </div>
@else
    <div>You are not allowed to make appointment request</div>
@endif