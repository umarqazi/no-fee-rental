
<!--List view listing-->
<div class="listing-wrapper">
    @foreach($buildings as $building)
        <div class="listing-row">
            <div class="img-holder">
                <img src="{{ asset($building->thumbnail ?? DLI) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
            </div>
            <div class="info">
                <p class="title">{{ $building->address }}</p>
                <p class="title">Total Apartments: {{ count($building->listings) }}</p>
                <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                @if($building->type === FEE)
                    <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building no fee">
                        <span class="status" style="background-color:red;">Fee</span>
                    </a>
                @else
                    <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building fee">
                        <span class="status" style="background-color:#223970;">No Fee</span>
                    </a>
                @endif
                <div class="actions-btns">
                    <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                        <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @if($buildings->total() < 1)
        <p class="null">No Record Found</p>
    @endif
    {!! $buildings->render() !!}
</div>

<!--Grid view listing-->
<div class="grid-view-wrapper">
    <div class="row">
        @foreach($buildings as $building)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="listing-thumb">
                    <img src="{{ asset( $building->thumbnail ?? DLI ) }}" alt="" style="height: 205px; width: 100%;" class="main-img" />
                    <div class="info">
                        <p class="title">
                            {{ $building->address }}
                        </p>
                        <p>Posted On: {{ $building->created_at->format("m/d/y H:m A") }}</p>
                        @if($building->type === FEE)
                            <a href="{{ route(whoAmI().'.noFeeBuilding', $building->id) }}" title="Make this building no fee">
                                <span class="status" style="background-color:red;">Fee</span>
                            </a>
                        @else
                            <a href="{{ route(whoAmI().'.feeBuilding', $building->id) }}" title="Make this building fee">
                                <span class="status" style="background-color:#223970;">No Fee</span>
                            </a>
                        @endif
                        <div class="actions-btns">
                            <a href="{{ route(whoAmI().'.editBuilding', $building->id) }}">
                                <span><img src="{{asset('assets/images/edit-icon.png')}}" alt=""></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($buildings->total() < 1)
            <p class="null">No Record Found</p>
        @endif
    </div>
    {!! $buildings->render() !!}
</div>