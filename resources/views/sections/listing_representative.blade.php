
<div class="appointment-section">
    @if($listing->building->user_id == $listing->user_id && !empty($listing->building->contact))
        <a href="{{ agents($listing->building->contact->id)->email_verified_at ? route('web.agentProfile', $listing->building->contact->id) : 'javascript:void(0);' }}">
            <ul>
                <li>
                    <img src="{{ Storage::url($listing->building->contact->profile_image ?? DUI) }}" alt="">
                </li>
                <li>
                    <h5> {{ $listing->building->contact->first_name.' '.$listing->building->contact->last_name }}</h5>
                    <p> {{ $listing->building->contact->company->company ?? 'None' }} </p>
                    <i class="far fa-comments"></i> {{ count($listing->building->contact->reviews) }} Renter Reviews
                </li>
            </ul>
        </a>
    @else
        <a href="{{ route('web.agentProfile', $listing->agent->id) }}">
            <ul>
                <li>
                    <img src="{{ Storage::url($listing->agent->profile_image ?? DUI) }}" alt="">
                </li>
                <li>
                    <h5> {{ $listing->agent->first_name.' '.$listing->agent->last_name }}</h5>
                    <p> {{ $listing->agent->company->company ?? 'None' }} </p>
                    <i class="far fa-comments"></i> {{ count($listing->agent->reviews) }} Renter Reviews
                </li>
            </ul>
        </a>
    @endif
</div>