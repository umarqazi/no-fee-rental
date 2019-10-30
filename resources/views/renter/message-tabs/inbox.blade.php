
@if($conversations->active->total() > 0)
    @foreach ($conversations->active as $inbox)
        <div class="message-row row">
            <div class="col-sm-6 col-lg-10 col-12">
                <h3>{{ sprintf("%s %s", $inbox->sender->first_name ?? $inbox->username, $inbox->sender->last_name ?? null) }}</h3>
            </div>
            <div class="col-sm-6 col-lg-2 col-12 view-buttons">
                <a href="{{ route('renter.loadConversation', $inbox->id) }}" class="view-chat-view"> View</a>
                <a href="{{ route('renter.archiveConversation', $inbox->id) }}" class="view-chat-archive"> Archive</a>
            </div>
            <div class="property">
                <img src="{{ asset($inbox->listing->thumbnail ?? DLI) }}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ str_formatting($inbox->listing->bedrooms, 'Bed') }}</li>
                        <li><i class="fa fa-bath"></i> {{ str_formatting($inbox->listing->baths, 'Bath') }}</li>
                    </ul>
                    <p>{{ is_exclusive($inbox->listing) }}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{ $inbox->listing->rent }}</div>
                </div>
            </div>
            <div class="date-text">
                {{ sprintf("%s on %s", ucfirst($inbox->appointment_time ?? 'Requested'), $inbox->appointment_date->format('D, d/m/y')) }}
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
