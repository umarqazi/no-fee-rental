
@if($conversations->inactive->total() > 0)
    @foreach ($conversations->inactive as $inbox)
        <div class="message-row">
            <div class="row conversation-pg-mrg">
                <div class="col-sm-12 col-lg-5 col-12">
                    <h3>{{ sprintf("%s %s", $inbox->sender->first_name ?? $inbox->username, $inbox->sender->last_name ?? null) }}</h3>
                    <p>Email: <strong><a href="javascript:void(0);" style="text-decoration:none;">{{ $inbox->email ?? $inbox->sender->email }}</a></strong></p>
                    <p>Phone No: <strong style="font-weight: 700;">{{ $inbox->phone_number ?? $inbox->sender->phone_number }}</strong></p>
                </div>
                <div class="message-section col-sm-12 col-lg-5 col-12">
                    <h3>Message</h3>
                    <p>{{ isset($inbox->messages) ? str_limit($inbox->messages->last()->message, 250, '...') : 'N/A' }}</p>
                </div>
                <div class="col-sm-6 col-lg-2 col-12">
                    <div class="conversation-buttons">
                        <a href="javascript:void(0);" id="accept" request_id="{{ $inbox->id }}" class="view-chat-view"> Accept</a>
                        <a href="{{ route('owner.archiveConversation', $inbox->id) }}" class="view-chat-archive deny" style="background: #ff5454;"> Deny</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="reply-back-modal"><a href="{{ route('owner.loadConversation', $inbox->id) }}" data-id="{{ $inbox->id }}">Reply Back</a></div>
                </div>
            </div>
            <div class="property">
                <img src="{{ is_realty_listing($inbox->listing->thumbnail) }}" alt="" />
                <div class="info">
                    <ul>
                        <li><i class="fa fa-bed"></i> {{ str_formatting($inbox->listing->bedrooms, 'Bed') }}</li>
                        <li><i class="fa fa-bath"></i> {{ str_formatting($inbox->listing->baths, 'Bath') }}</li>
                    </ul>
                    <p>{{ is_exclusive($inbox->listing) }}</p>
                    <div class="price"><i class="fa fa-tag"></i> ${{ ($inbox->listing->rent) ?   number_format($inbox->listing->rent,0) : 'None' }}</div>
                </div>
            </div>
            <div class="date-text">
                <div style="text-align: right;"><strong style='color:#000;'>({{ $inbox->conversation_type == APPOINTMENT ? 'Appointment' : 'Availability' }} Request)</strong></div>
                <div style="text-align: right;">{{ sprintf("Requested on %s", $inbox->created_at->format('D, m/d/y h:i a')) }}</div>
            </div>
        </div>
    @endforeach
@else
    No Record Found
@endif
