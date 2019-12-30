
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings->non_verified as $building)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($building->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $building->address }}</p>
                <p class="title">Total Agents: {{ count($building->listings) }}</p>
                <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                <span class="status" style="background-color:red;">Pending Request</span>
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.buildingDetails', $building->id) }}" title="Verify this building">
                        <button type="button" class="border-btn">Verify</button>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->non_verified->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->non_verified->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings->non_verified as $al)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $building->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ $building->address }}
                        </p>
                        <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                        <span class="status" style="background-color:red;">Pending Request</span>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.buildingDetails', $building->id) }}" title="Verify this building">
                                <button type="button" class="border-btn">Verify</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->non_verified->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->non_verified->render() !!}
</div>
