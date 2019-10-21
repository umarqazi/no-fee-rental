
{{--
@if( $data->availabilities->total() > 0)
    @foreach ($data->availabilities as $availability)
--}}
        <div class="message-row row">
            <div class="col-sm-10">
                <h3>{{--{{ $availability->username }}--}}</h3>
            </div>
            <div class="col-sm-2">
                <a href="{{--{{ route('agent.loadAvailabilityChat', $availability->id) }}--}}" class="view-chat"> View</a>
                <a href="{{--{{ route('agent.archiveAvailabilityChat', $availability->id) }}--}}" class="view-chat-archive"> Archive Chat</a>
            </div>
            <div class="property">
                <img src="{{--{{ asset($availability->listing->thumbnail ?? DLI) }}--}}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i>{{-- {{ str_formatting($availability->listing->bedrooms, 'Bed') }}--}}</li>
                        <li><i class="fa fa-bath"></i> {{--{{ str_formatting($availability->listing->baths, 'Bath') }}--}}</li>
                    </ul>
                    <p>{{--{{ is_exclusive($availability->listing) }}--}}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{--{{ $availability->listing->rent }}--}}</div>
                </div>
            </div>
            <div class="date-text">
                {{--{{ $availability->created_at->format('D, d/m/y h:i a') }}--}}
            </div>
        </div>
    {{--@endforeach
@else--}}
    No Record Found
{{--@endif--}}
