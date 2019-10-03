<div class="calendar-wrap">
    <!--calendar slider -->
    <h3>Request for Schedule </h3>
    {!! Form::open() !!}
    <div class="calendarCarasoule">
        <div class="owl-carousel owl-theme" id="calendar-slider">
            @for($i = 0; $i < 14; $i ++)
                @php $date = now()->addDay($i); @endphp
                <div class="item">
                    <div class="appointment-radio-btn">
                        <div class="selection">
                            {!! Form::radio('date', $date->format('m/d/Y'), false, ['id' => "date{$i}"]) !!}
                            <label for="date{{ $i }}">{{ $date->format('l') }} <br>
                                <span> {{ $date->format('d') }} </span>
                            </label>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!-- end calendar slider -->
    <!-- radio button -->
    <div class="appointment-radio-btn">
        <div class="selection">
            <input id="Morning" name="Appointment" type="radio">
            <label for="Morning">Morning <br>
                10am - 12pm
            </label>
        </div>
        <div class="selection">
            <input id="Afternoon" name="Appointment" type="radio">
            <label for="Afternoon">Afternoon <br>
                12pm - 3pm
            </label>
        </div>
        <div class="selection">
            <input id="Evening" name="Appointment" type="radio">
            <label for="Evening">Evening <br>
                3pm - 6pm
            </label>
        </div>
    </div>
    <div class="after-radio-textarea">
        <textarea class="form-control" placeholder="Message"></textarea>
        <button type="submit"><img src="/assets/images/send-msg.png" alt="" /></button>
    </div>
    {!! Form::close() !!}
    <!--end radio button -->
</div>
