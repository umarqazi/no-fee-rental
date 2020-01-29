
@if($conversations->archived->total() > 0)
    @foreach ($conversations->archived as $archive)
        <div class="message-row">
            <div class="row conversation-pg-mrg">
            <div class="col-sm-6 col-lg-10 col-12">
                <h3>{{ sprintf("%s %s", $archive->sender->first_name ?? $archive->username, $archive->sender->last_name ?? null) }}</h3>
            </div>
            <div class="col-sm-6 col-lg-2 col-12 view-buttons">
                <a href="{{ route('agent.loadConversation', $archive->id) }}" class="view-chat-view"> View</a>
                <a href="{{ route('agent.unArchiveConversation', $archive->id) }}" class="view-chat-archive"> UnArchive</a>
            </div>
            </div>
            <div class="property">
                <img src="{{ asset($archive->listing->thumbnail ?? DLI) }}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ str_formatting($archive->listing->bedrooms, 'Bed') }}</li>
                        <li><i class="fa fa-bath"></i> {{ str_formatting($archive->listing->baths, 'Bath') }}</li>
                    </ul>
                    <p>{{ is_exclusive($archive->listing) }}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{ ($archive->listing->rent) ?   number_format($archive->listing->rent,0) : 'None' }}</div>
                </div>
            </div>
            <div class="date-text">
                {{ sprintf("%s on %s", ucfirst($archive->appointment_time), $archive->appointment_date->format('D, d/m/y')) }}
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
