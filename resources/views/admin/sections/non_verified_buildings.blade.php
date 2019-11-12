
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
                <a href="{{ route(whoAmI().'.buildingDetails', $building->id) }}" title="Verify this building">
                    <span class="status" style="background-color:red;">Verify</span>
                </a>
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
                        <a href="{{ route(whoAmI().'.buildingDetails', $building->id) }}" title="Approve this building">
                            <span class="status" style="background-color:red;">Verify</span>
                        </a>
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                                <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
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
