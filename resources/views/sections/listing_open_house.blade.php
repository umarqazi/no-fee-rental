
<h3> Open House</h3>
@if(isOpenToday($listing->openHouse))
    <div class="open-house-inner">
        <div class="open-timings">
            <p>{{ carbon($listing->openHouse->date)->format('D, M y'). ' | '. $listing->openHouse->start_time . ' - ' . $listing->openHouse->end_time }}</p>
        </div>
        <div class="apointment-interest-section">
            @if($listing->openHouse->only_appt)
                <span> (By appointment only)</span>
            @elseif(isRenter())
                <button class="btn btn-default interested">Interested</button>
            @endif
                <div class="request-send" style="display: none;">
                    <i class="fas fa-check-circle"></i>Request Sent
                </div>
        </div>
    </div>
@endif

<script>
    $('.interested').on('click', async function () {
        let id = '{{ $listing->id }}';
        await ajaxRequest(`/interested/${id}`, 'post').then(res => {
            $('.interested').hide();
            $('.request-send').show();
        });
    });
</script>