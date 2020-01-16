
@if(isRenter())
    <div class="calendar-wrap">
        <!--calendar slider -->
        <h3>Request for Schedule </h3>
        {!! Form::open(['url' => route('web.listConversation'), 'id' => 'appointment-form']) !!}
        {!! Form::hidden('type', APPOINTMENT) !!}
        {!! Form::hidden('to', $listing->building->contact->id ?? $listing->agent->id) !!}
        {!! Form::hidden('listing_id', $listing->id) !!}
        <div class="calendarCarasoule">
            <div class="owl-carousel owl-theme" id="calendar-slider">
                @for($i = 0; $i <= 30; $i ++)
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
        <span class="app-date-error" style="padding-left: 10px; color : red;font-size: 12px;margin-top: 7px;display: inline-block;"></span>
        <div class="appointment-radio-btn">
            <div class="selection">
                <input id="Morning" name="appointment_time" value="10am" type="radio">
                <label for="Morning">Morning <br>
                    10am - 12pm
                </label>
            </div>
            <div class="selection">
                <input id="Afternoon" name="appointment_time" value="12pm" type="radio">
                <label for="Afternoon">Afternoon <br>
                    12pm - 3pm
                </label>
            </div>
            <div class="selection">
                <input id="Evening" name="appointment_time" value="4pm" type="radio">
                <label for="Evening">Evening <br>
                    3pm - 7pm
                </label>
            </div>
        </div>
        <span class="app-time-error" style="padding-left: 10px; color : red;font-size: 12px;margin-top: 9px;display: inline-block;"></span>
        <div class="after-radio-textarea">
            {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message','id'=>'appointment-message','maxlength' => '500']) !!}
            <p id="counter"></p>
            <button class="appointment-submit-button" type="button"><img src="{{ asset('assets/images/send-msg.png') }}" alt="" /></button>
        </div>
        <span class="app-message-error" style="padding-left: 10px; color : red;font-size: 12px;position: relative; top: -15px;"></span>
        {!! Form::close() !!}
    </div>
@else
    <div class="not-allowed-appointment"> You are not allowed to make appointment request</div>
@endif

<script>
    $('.calendarCarasoule #calendar-slider').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:3
            },
            600:{
                items:6
            },
            768:{
                items:7
            },
            992:{
                items:4
            },
            1024:{
                items:4
            },
            1366:{
                items:5
            }
        }
    });
</script>
